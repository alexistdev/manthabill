<?php

use App\Models\Setting;

if (!function_exists('cetak')) {
    /**
     * HTML-encode a value for safe output (equivalent to CI3 cetak()).
     */
    function cetak(string|int|float|null $str): string
    {
        return htmlentities((string) $str, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('encrypt_url')) {
    /**
     * Encrypt a DB ID for use in URLs (replaces CI3 AES-256-CBC security.ini approach).
     * Uses Laravel's encrypt() which is HMAC-verified AES-256-CBC via APP_KEY.
     */
    function encrypt_url(int|string $id): string
    {
        return encrypt((string) $id);
    }
}

if (!function_exists('decrypt_url')) {
    /**
     * Decrypt a URL-encoded ID. Returns null on failure (tampered/invalid payload).
     */
    function decrypt_url(?string $encrypted): ?string
    {
        if ($encrypted === null || $encrypted === '') {
            return null;
        }
        try {
            return decrypt($encrypted);
        } catch (Throwable) {
            return null;
        }
    }
}

if (!function_exists('konversiTanggal')) {
    /**
     * Convert SQL date (yyyy-mm-dd) to Indonesian display format (dd-mm-yyyy).
     */
    function konversiTanggal(?string $date): string
    {
        if (empty($date)) {
            return '';
        }
        return date('d-m-Y', strtotime($date));
    }
}

if (!function_exists('konversiUnixTanggal')) {
    /**
     * Convert Unix timestamp to Indonesian display format (dd-mm-yyyy).
     */
    function konversiUnixTanggal(?int $ts): string
    {
        if (empty($ts)) {
            return '';
        }
        return date('d-m-Y', $ts);
    }
}

if (!function_exists('tanggalSQL')) {
    /**
     * Convert dd-mm-yyyy display date to SQL yyyy-mm-dd format.
     */
    function tanggalSQL(string $date): string
    {
        [$d, $m, $y] = explode('-', $date);
        return "$y-$m-$d";
    }
}

if (!function_exists('konversiRupiah')) {
    /**
     * Format integer as Indonesian Rupiah display (e.g. 1.234.567).
     */
    function konversiRupiah(int $amount): string
    {
        return number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('_angkaUnik')) {
    /**
     * Generate a random lowercase alphanumeric string (equivalent to CI3 _angkaUnik()).
     * Default 5 chars for invoice numbers; 20 chars for ticket keys.
     */
    function _angkaUnik(int $length = 5): string
    {
        $chars  = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $result;
    }
}

if (!function_exists('diskonUnik')) {
    /**
     * Random unique discount value between 100–999 IDR.
     */
    function diskonUnik(): int
    {
        return random_int(100, 999);
    }
}

if (!function_exists('kirim_email')) {
    /**
     * Queue an outbound email by inserting into tbemail (status=2 = pending).
     * Equivalent to CI3 kirim_email() helper — never sends synchronously.
     */
    function kirim_email(string $emailTujuan, string $pesan, string $judul): void
    {
        $setting = Setting::current();
        $sender  = $setting?->email_hosting ?? config('mail.from.address', 'noreply@manthabill.com');

        \App\Models\EmailQueue::create([
            'email_pengirim' => $sender,
            'email_tujuan'   => $emailTujuan,
            'subyek'         => $judul,
            'email_pesan'    => $pesan,
            'status'         => 2,
        ]);
    }
}
