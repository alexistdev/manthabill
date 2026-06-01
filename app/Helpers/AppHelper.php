<?php

use App\Models\Setting;

if (!function_exists('konversiTanggal')) {
    function konversiTanggal(?string $date): string
    {
        if (empty($date)) {
            return '';
        }
        return date('d-m-Y', strtotime($date));
    }
}

if (!function_exists('konversiUnixTanggal')) {
    function konversiUnixTanggal(?int $ts): string
    {
        if (empty($ts)) {
            return '';
        }
        return date('d-m-Y', $ts);
    }
}

if (!function_exists('tanggalSQL')) {
    function tanggalSQL(string $date): string
    {
        [$d, $m, $y] = explode('-', $date);
        return "$y-$m-$d";
    }
}

if (!function_exists('konversiRupiah')) {
    function konversiRupiah(int $amount): string
    {
        return number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('kirim_email')) {
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
