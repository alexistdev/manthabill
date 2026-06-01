<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    /**
     * Calculate the next sequential client number.
     *
     * Business rule (CI3 parity):
     *   1. Read prefix from tbsetting (treat 0 as 1).
     *   2. Get MAX(client) from tbuser.
     *   3. If no users exist → use prefix. Else → max + 1.
     */
    public function generateClientNumber(): int
    {
        $setting = Setting::current();
        $prefix  = (int) ($setting?->prefix ?? 1);
        if ($prefix === 0) {
            $prefix = 1;
        }

        $maxClient = User::max('client');

        if ($maxClient === null || $maxClient === 0) {
            return $prefix;
        }

        return $maxClient + 1;
    }

    /**
     * Create a new customer (tbuser + tbdetailuser) and optionally queue a welcome email.
     *
     * @param array{email:string, password:string, status?:int, send_email?:bool} $data
     */
    public function createCustomer(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'client'      => $this->generateClientNumber(),
                'password'    => Hash::make($data['password']),
                'email'       => $data['email'],
                'date_create' => now()->toDateString(),
                'ip'          => $data['ip'] ?? null,
                'status'      => $data['status'] ?? User::STATUS_UNVERIFIED,
                'validasi_token' => $data['validasi_token'] ?? null,
            ]);

            UserDetail::create([
                'id_user' => $user->id_user,
                'gambar'  => 'default.jpg',
            ]);

            return $user;
        });
    }

    /**
     * Suspend a customer account (status → 3).
     * Queues a suspension email.
     */
    public function suspend(User $user): void
    {
        $user->update(['status' => User::STATUS_SUSPENDED]);

        $setting   = Setting::current();
        $namaUsaha = $setting?->nama_hosting ?? 'ManthaBill';
        $detail    = $user->detail;
        $namaUser  = $this->resolveDisplayName($detail);

        $judul   = "Akun anda di {$namaUsaha} telah disuspend";
        $message = "
            Yth. {$namaUser}<br><br>
            Dengan sangat menyesal kami harus mensuspend akun anda, dikarenakan telah melanggar ketentuan layanan kami.<br>
            Jika anda keberatan dengan kebijakan kami ini, silahkan menghubungi Customer Service kami.<br><br>
            Regards<br>
            Admin
        ";

        kirim_email($user->email, $message, $judul);
    }

    /**
     * Activate a suspended or unverified customer account (status → 1).
     * Queues a reactivation email.
     */
    public function activate(User $user): void
    {
        $user->update(['status' => User::STATUS_ACTIVE]);

        $setting   = Setting::current();
        $namaUsaha = $setting?->nama_hosting ?? 'ManthaBill';
        $detail    = $user->detail;
        $namaUser  = $this->resolveDisplayName($detail);

        $judul   = "Akun anda di {$namaUsaha} telah diaktifkan kembali";
        $message = "
            Yth. {$namaUser}<br><br>
            Akun anda telah berhasil diaktifkan kembali. Silahkan login.<br><br>
            Regards<br>
            Admin
        ";

        kirim_email($user->email, $message, $judul);
    }

    /**
     * Resolve display name from UserDetail (matches CI3 logic for name display).
     */
    private function resolveDisplayName(?UserDetail $detail): string
    {
        $first = trim($detail?->nama_depan ?? '');
        $last  = trim($detail?->nama_belakang ?? '');

        if ($first === '' && $last === '') {
            return 'Member';
        }

        return trim($first . ' ' . $last);
    }
}
