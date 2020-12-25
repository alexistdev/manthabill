<?php
defined('BASEPATH') or exit('No direct script access allowed');
function cetak($str)
{
	echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function filter_domain($nameDomain, $tldName)
{
	//menghilangkan http, slash dan backslash
	$domainFilter1 = stripslashes(preg_replace('/https|http/', '', $nameDomain));
	$domainFilter1 = str_replace('/', '', $domainFilter1);
	$domainFilter1 =  str_replace(':', "", $domainFilter1);

	//menghilangkan www
	$domainFilter2 = str_replace("www.", "", $domainFilter1);

	//menghilangkan tld dibelakangnya
	$domainFilter3  = stristr($domainFilter2, '.', true);

	if (empty($domainFilter3)) {
		$domainJadi = $domainFilter2 . '.' . $tldName;
	} else {
		$domainJadi = $domainFilter3 . '.' . $tldName;
	}
	return $domainJadi;
}
