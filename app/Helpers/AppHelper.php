<?php

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

