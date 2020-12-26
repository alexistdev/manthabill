<?php
defined('BASEPATH') or exit('No direct script access allowed');
function cetak($str)
{
	return htmlentities($str, ENT_QUOTES, 'UTF-8');
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

function encrypt_url($string) {

	$output = false;
	/*
	* read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
	*/
	$security       = parse_ini_file("security.ini");
	$secret_key     = $security["encryption_key"];
	$secret_iv      = $security["iv"];
	$encrypt_method = $security["encryption_mechanism"];

	// hash
	$key    = hash("sha256", $secret_key);

	// iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
	$iv     = substr(hash("sha256", $secret_iv), 0, 16);

	//do the encryption given text/string/number
	$result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($result);
	return $output;
}

function decrypt_url($string) {

	$output = false;
	/*
	* read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
	*/

	$security       = parse_ini_file("security.ini");
	$secret_key     = $security["encryption_key"];
	$secret_iv      = $security["iv"];
	$encrypt_method = $security["encryption_mechanism"];

	// hash
	$key    = hash("sha256", $secret_key);

	// iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
	$iv = substr(hash("sha256", $secret_iv), 0, 16);

	//do the decryption given text/string/number

	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	return $output;
}
