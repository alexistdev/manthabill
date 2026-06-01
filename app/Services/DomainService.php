<?php

namespace App\Services;

class DomainService
{
    public static function filter(string $domain, string $tld): string
    {
        $d = stripslashes(preg_replace('/https|http/', '', $domain));
        $d = str_replace(['/', ':'], '', $d);
        $d = str_replace('www.', '', $d);

        $name = stristr($d, '.', true);

        if (empty($name)) {
            return $d . '.' . $tld;
        }

        return $name . '.' . $tld;
    }
}
