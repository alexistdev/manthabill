<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCi3DatabaseCommand extends Command
{
    protected $signature = 'db:import-ci3
                            {--force : Skip confirmation prompt}';

    protected $description = 'Import production data from manthabill_ci3 into the Laravel schema';

    private const SRC = 'ci3';

    private array $report = [];

    public function handle(): int
    {
        if (!$this->verifySourceConnection()) {
            return self::FAILURE;
        }

        if (!$this->option('force')) {
            $src = config('database.connections.ci3.database');
            $dst = config('database.connections.' . config('database.default') . '.database');

            if (!$this->confirm("Import from [{$src}] into [{$dst}]? All target tables will be truncated.")) {
                $this->line('Aborted.');
                return self::SUCCESS;
            }
        }

        $this->info('Starting CI3 → Laravel data import...');
        $this->newLine();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        try {
            $this->runPhase1();
            $this->runPhase2();
            $this->runPhase3();
            $this->runPhase4();
            // Phase 5: ci_sessions — never import
        } catch (\Throwable $e) {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            $this->error('Import failed: ' . $e->getMessage());
            return self::FAILURE;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->newLine();
        $this->printReport();
        $this->newLine();
        $this->runValidation();

        return self::SUCCESS;
    }

    // ─── Phase 1: Direct imports ────────────────────────────────────────────

    private function runPhase1(): void
    {
        $this->line('<fg=cyan>Phase 1 — Direct imports</>');

        $this->importTable('tbsetting', 'tbsetting', fn($r) => (array) $r);

        $this->importTable('tbadmin', 'tbadmin', fn($r) => (array) $r);

        $this->importTable('tbproduct', 'products', fn($r) => [
            'id'               => $r->id_product,
            'nama_product'     => $r->nama_product,
            'type_product'     => $r->type_product,
            'harga'            => $r->harga,
            'kapasitas'        => $r->kapasitas,
            'bandwith'         => $r->bandwith,
            'addon_domain'     => $r->addon_domain,
            'email_account'    => $r->email_account,
            'database_account' => $r->database_account,
            'ftp_account'      => $r->ftp_account,
            'siklus'           => $r->siklus,
            'pilihan_1'        => $r->pilihan_1,
            'pilihan_2'        => $r->pilihan_2,
            'pilihan_3'        => $r->pilihan_3,
            'pilihan_4'        => $r->pilihan_4,
        ]);

        $this->importTable('tbberita', 'news', fn($r) => [
            'id'           => $r->id_berita,
            'judul_berita' => $r->judul_berita,
            'isi_berita'   => $r->isi_berita,
            'tgl_berita'   => $r->tgl_berita,
        ]);

        $this->importTable('tbmodul', 'modules', fn($r) => [
            'id'         => $r->id_modul,
            'nama_modul' => $r->nama_modul,
            'api_key'    => $r->api_key,
            'status'     => $r->status,
        ]);

        $this->importTable('tbtld', 'tlds', fn($r) => [
            'id'         => $r->id_tld,
            'tld'        => $r->tld,
            'harga_tld'  => $r->harga_tld,
            'status_tld' => $r->status_tld,
            'default'    => $r->default,
        ]);

        $this->importTable('tblocked', 'lockeds', fn($r) => [
            'id'               => $r->id_locked,
            'gagal_pertama'    => $r->gagal_pertama,
            'ip'               => $r->ip,
            'durasi_terkunci'  => $r->durasi_terkunci,
            'status'           => $r->status,
            'failed_count'     => $r->failed_count,
        ]);
    }

    // ─── Phase 2: User tables ───────────────────────────────────────────────

    private function runPhase2(): void
    {
        $this->newLine();
        $this->line('<fg=cyan>Phase 2 — User tables</>');

        // tbuser keeps its own table name and all original column names
        $this->importTable('tbuser', 'tbuser', fn($r) => [
            'id_user'        => $r->id_user,
            'client'         => $r->client,
            'password'       => $r->password, // never rehash
            'email'          => $r->email,
            'date_create'    => $r->date_create,
            'ip'             => $r->ip,
            'status'         => $r->status,
            'time_req'       => $r->time_req,
            'token_req'      => $r->token_req,
            'validasi_token' => $r->validasi_token,
            'timepin'        => $r->timepin,
            'sec_pin'        => $r->sec_pin,
        ]);

        $this->importTable('tbdetailuser', 'tbdetailuser', fn($r) => [
            'id_detail'      => $r->id_detail,
            'id_user'        => $r->id_user,
            'nama_depan'     => $r->nama_depan,
            'nama_belakang'  => $r->nama_belakang,
            'nama_usaha'     => $r->nama_usaha,
            'alamat'         => $r->alamat,
            'alamat2'        => $r->alamat2,
            'kota'           => $r->kota,
            'provinsi'       => $r->provinsi,
            'negara'         => $r->negara,
            'kodepos'        => $r->kodepos,
            'phone'          => $r->phone,
            'time_req'       => $r->time_req,
            'gambar'         => $r->gambar,
        ]);

        $this->importTable('tbtoken', 'tbtoken', fn($r) => [
            'id_token' => $r->id_token,
            'id_user'  => $r->id_user,
            'token'    => $r->token,
            'time'     => $r->time,
        ]);
    }

    // ─── Phase 3: Business tables ───────────────────────────────────────────

    private function runPhase3(): void
    {
        $this->newLine();
        $this->line('<fg=cyan>Phase 3 — Business tables</>');

        $this->importTable('tbvps', 'vps', fn($r) => [
            'id'            => $r->id_vps,
            'nama_vps'      => $r->nama_vps,
            'harga_vps'     => $r->harga_vps,
            'kapasitas_vps' => $r->kapasitas_vps,
            'bandwith_vps'  => $r->bandwith_vps,
            'core_vps'      => $r->core_vps,
            'ram_vps'       => $r->ram_vps,
            'pilihan_1'     => $r->pilihan_1,
            'pilihan_2'     => $r->pilihan_2,
            'pilihan_3'     => $r->pilihan_3,
            'pilihan_4'     => $r->pilihan_4,
            'status'        => $r->status,
        ]);

        $this->importTable('tbcategory_config', 'category_configs', fn($r) => [
            'id'   => $r->id_category,
            'name' => $r->name,
        ]);

        $this->importTable('tbconfig_option', 'config_options', fn($r) => [
            'id'            => $r->id_config,
            'id_vps'        => $r->id_vps,
            'id_category'   => $r->id_category,
            'name_config'   => $r->name_config,
            'detail_config' => $r->detail_config,
            'harga_config'  => $r->harga_config,
        ]);

        $this->importTable('tbvpsservice', 'vps_services', fn($r) => [
            'id'        => $r->id_vpsservice,
            'id_vps'    => $r->id_vps,
            'deskripsi' => $r->deskripsi,
            'harga'     => $r->harga,
        ]);

        $this->importTable('tbvpstransit', 'vps_transits', fn($r) => [
            'id'             => $r->id_vpstransit,
            'user_id'        => $r->user_id,
            'timestamp'      => $r->timestamp,
            'nama_variabel'  => $r->nama_variabel,
            'nilai_variabel' => $r->nilai_variabel,
        ]);

        // hostings must come before invoices (FK: invoices.id_hosting → hostings.id)
        $this->importTable('tbhosting', 'hostings', fn($r) => [
            'id'             => $r->id_hosting,
            'id_product'     => $r->id_product,
            'user_id'        => $r->id_user,   // id_user → user_id
            'nama_hosting'   => $r->nama_hosting,
            'user_cpanel'    => $r->user_cpanel,
            'harga'          => $r->harga,
            'start_hosting'  => $r->start_hosting,
            'end_hosting'    => $r->end_hosting,
            'domain'         => $r->domain,
            'status_hosting' => $r->status_hosting,
        ]);

        $this->importTable('tbinvoice', 'invoices', fn($r) => [
            'id'            => $r->id_invoice,
            'user_id'       => $r->id_user,     // id_user → user_id
            'id_hosting'    => $r->id_hosting,  // column name preserved
            'no_invoice'    => $r->no_invoice,
            'detail_produk' => $r->detail_produk,
            'due'           => $r->due,
            'inv_date'      => $r->inv_date,
            'sub_total'     => $r->sub_total,
            'diskon_inv'    => $r->diskon_inv,
            'pajak_inv'     => $r->pajak_inv,
            'total_jumlah'  => $r->total_jumlah,
            'status_inv'    => $r->status_inv,
            'token_inv'     => $r->token_inv,
        ]);

        $this->importTable('tbkonfirmasi', 'payment_confirmations', fn($r) => [
            'id'                   => $r->id_konfirmasi,
            'invoice_id'           => $r->id_invoice,   // id_invoice → invoice_id
            'user_id'              => $r->id_user,       // id_user → user_id
            'nama_pengirim'        => $r->nama_pengirim,
            'bank_pengirim'        => $r->bank_pengirim,
            'no_invoice'           => $r->no_invoice,
            'tanggal_konfirmasi'   => $r->tanggal_konfirmasi,
            'total_bayar'          => $r->total_bayar,
            'status'               => $r->status,
        ]);

        $this->importTable('tbdomain', 'domains', fn($r) => [
            'id'           => $r->id_domain,
            'user_id'      => $r->id_user,   // id_user → user_id
            'tld_id'       => $r->id_tld,    // id_tld → tld_id
            'nama_domain'  => $r->nama_domain,
            'nameserver1'  => $r->nameserver1,
            'nameserver2'  => $r->nameserver2,
            'nameserver3'  => $r->nameserver3,
            'nameserver4'  => $r->nameserver4,
            'nameserver5'  => $r->nameserver5,
            'date_register' => $r->date_register,
            'due_date'     => $r->due_date,
            'status'       => $r->status,
        ]);

        $this->importTable('tbdomaintransit', 'domain_transits', fn($r) => [
            'id'          => $r->id_domtrans,
            'user_id'     => $r->id_user,    // id_user → user_id
            'id_tld'      => $r->id_tld,     // column name preserved
            'nama_domain' => $r->nama_domain,
        ]);

        $this->importTable('tbdomainwhois', 'domain_whois', fn($r) => [
            'id'             => $r->id_domainwhois,
            'id_domain'      => $r->id_domain,
            'nama_depan'     => $r->nama_depan,
            'nama_belakang'  => $r->nama_belakang,
            'nama_usaha'     => $r->nama_usaha,
            'no_telp'        => $r->no_telp,
            'email'          => $r->email,
            'alamat1'        => $r->alamat1,
            'alamat2'        => $r->alamat2,
            'kota'           => $r->kota,
            'provinsi'       => $r->provinsi,
            'kodepos'        => $r->kodepos,
            'negara'         => $r->negara,
        ]);
    }

    // ─── Phase 4: Communication tables ─────────────────────────────────────

    private function runPhase4(): void
    {
        $this->newLine();
        $this->line('<fg=cyan>Phase 4 — Communication tables</>');

        $this->importTable('tbinbox', 'inboxes', fn($r) => [
            'id'           => $r->id_inbox,
            'user_id'      => $r->id_user,    // id_user → user_id
            'is_adm'       => $r->is_adm,
            'judul'        => $r->judul,
            'pesan'        => $r->pesan,
            'key_token'    => $r->key_token,
            'time'         => $r->time,
            'status_inbox' => $r->status_inbox,
        ]);

        $this->importTable('inboxbalas', 'inbox_replies', fn($r) => [
            'id'       => $r->id_balas,
            'is_admin' => $r->is_admin,
            'key_token' => $r->key_token,
            'pesan'    => $r->pesan,
            'time'     => $r->time,
        ]);

        // tbemail keeps its original table name in Laravel
        $this->importTable('tbemail', 'tbemail', fn($r) => [
            'id_email'        => $r->id_email,
            'email_pengirim'  => $r->email_pengirim,
            'email_tujuan'    => $r->email_tujuan,
            'subyek'          => $r->subyek,
            'email_pesan'     => $r->email_pesan,
            'status'          => $r->status,
        ]);

        $this->importTable('tblogmail', 'mail_logs', fn($r) => [
            'id'          => $r->id_logmail,
            'email_tujuan' => $r->email_tujuan,
            'waktukirim'  => $r->waktukirim,
        ]);
    }

    // ─── Internals ───────────────────────────────────────────────────────────

    private function importTable(string $src, string $dst, callable $transform): void
    {
        $rows   = $this->src()->table($src)->get();
        $total  = $rows->count();
        $mapped = $rows->map($transform)->filter()->values();

        DB::table($dst)->truncate();

        $imported = 0;
        $failed   = 0;

        if ($mapped->isNotEmpty()) {
            foreach ($mapped->chunk(500) as $chunk) {
                try {
                    DB::table($dst)->insert($chunk->toArray());
                    $imported += $chunk->count();
                } catch (\Throwable $e) {
                    $failed += $chunk->count();
                    $this->warn("  ! {$src} → {$dst}: " . $e->getMessage());
                }
            }
        }

        $skipped = $total - $imported - $failed;

        $this->report[$dst] = [
            'source'   => $total,
            'imported' => $imported,
            'failed'   => $failed,
            'skipped'  => $skipped,
        ];

        $icon = $failed > 0 ? '<fg=yellow>!</>' : '<fg=green>✓</>';
        $this->line("  {$icon} {$src} → {$dst}: {$imported}/{$total}");
    }

    private function src(): \Illuminate\Database\Connection
    {
        return DB::connection(self::SRC);
    }

    // ─── Validation ──────────────────────────────────────────────────────────

    private function runValidation(): void
    {
        $this->line('<fg=cyan>Validation</>');

        $checks = [
            ['label' => 'User count',    'src' => 'tbuser',    'dst' => 'tbuser'],
            ['label' => 'Invoice count', 'src' => 'tbinvoice', 'dst' => 'invoices'],
            ['label' => 'Hosting count', 'src' => 'tbhosting', 'dst' => 'hostings'],
            ['label' => 'Domain count',  'src' => 'tbdomain',  'dst' => 'domains'],
            ['label' => 'Inbox count',   'src' => 'tbinbox',   'dst' => 'inboxes'],
        ];

        $allPassed = true;

        foreach ($checks as $check) {
            $srcCount = $this->src()->table($check['src'])->count();
            $dstCount = DB::table($check['dst'])->count();
            $pass     = $srcCount === $dstCount;
            $allPassed = $allPassed && $pass;
            $icon     = $pass ? '<fg=green>✓</>' : '<fg=red>✗</>';
            $this->line("  {$icon} {$check['label']}: source={$srcCount}, imported={$dstCount}");
        }

        // Relationship checks
        $this->newLine();
        $this->line('  Relationship checks:');
        $this->checkRelationship('User→Detail', 'tbuser', 'id_user', 'tbdetailuser', 'id_user');
        $this->checkRelationship('Invoice→User', 'invoices', 'user_id', 'tbuser', 'id_user');
        $this->checkRelationship('Inbox→Replies', 'inbox_replies', 'key_token', 'inboxes', 'key_token');

        $this->newLine();
        if ($allPassed) {
            $this->info('All count validations passed.');
        } else {
            $this->warn('Some count validations failed — check report above.');
        }
    }

    private function checkRelationship(string $label, string $table, string $col, string $refTable, string $refCol): void
    {
        try {
            $orphans = DB::table($table)
                ->whereNotIn($col, DB::table($refTable)->pluck($refCol))
                ->count();

            $icon = $orphans === 0 ? '<fg=green>✓</>' : '<fg=yellow>!</>';
            $suffix = $orphans > 0 ? " ({$orphans} orphaned records — expected if source had deletions)" : '';
            $this->line("    {$icon} {$label}{$suffix}");
        } catch (\Throwable $e) {
            $this->line("    <fg=yellow>!</> {$label}: skipped ({$e->getMessage()})");
        }
    }

    // ─── Report ──────────────────────────────────────────────────────────────

    private function printReport(): void
    {
        $this->line('<fg=cyan>Import Report</>');
        $this->line(str_repeat('-', 70));
        $this->line(sprintf('  %-30s %8s %10s %8s %8s', 'Table', 'Source', 'Imported', 'Failed', 'Skipped'));
        $this->line(str_repeat('-', 70));

        $totalSrc = $totalImported = $totalFailed = $totalSkipped = 0;

        foreach ($this->report as $table => $r) {
            $this->line(sprintf(
                '  %-30s %8d %10d %8d %8d',
                $table,
                $r['source'],
                $r['imported'],
                $r['failed'],
                $r['skipped']
            ));
            $totalSrc      += $r['source'];
            $totalImported += $r['imported'];
            $totalFailed   += $r['failed'];
            $totalSkipped  += $r['skipped'];
        }

        $this->line(str_repeat('-', 70));
        $this->line(sprintf(
            '  %-30s %8d %10d %8d %8d',
            'TOTAL',
            $totalSrc,
            $totalImported,
            $totalFailed,
            $totalSkipped
        ));
        $this->line(str_repeat('-', 70));
    }

    // ─── Connection check ────────────────────────────────────────────────────

    private function verifySourceConnection(): bool
    {
        try {
            $this->src()->getPdo();
            return true;
        } catch (\Throwable $e) {
            $this->error('Cannot connect to source database (ci3): ' . $e->getMessage());
            $this->line('Steps to set up the source database:');
            $this->line('  1. mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS manthabill_ci3"');
            $this->line('  2. mysql -u root -p manthabill_ci3 < manthabill.sql');
            $this->line('  3. Verify CI3_DB_* vars in .env');
            return false;
        }
    }
}
