<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * ManthaBill V.2.0
 *
 * Software Billing ini ditujukan untuk pemula hoster
 * Low Budget dan ingin memulai usaha selling hosting.
 *
 * Dikembangkan oleh: AlexistDev
 * Kontak: www.alexistdev.com
 *
 * Software ini gratis.Namun jika anda ingin support pengembangan software ini
 * Silahkan donasikan $1 ke paypal:alexistdev@gmail.com
 *
 * Terimakasih atas dukungan anda.
 *
 */

/** Dengan SMTP2GO */
//$config['protocol'] = 'smtp';
//$config['smtp_host'] = 'mail.smtp2go.com';
//$config['smtp_port'] = '587'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
////$config['smtp_crypto'] = 'none';
//$config['smtp_user'] = 'alexistdev@gmail.com';
//$config['smtp_pass'] = '4jtvvA84g2BU';

/** Dengan SMTP Lokal */
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.adrihostbill.xyz';
$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$config['smtp_crypto'] = 'ssl';
$config['smtp_user'] = 'support@adrihostbill.xyz';
$config['smtp_pass'] = '#6s$FkBtSvBN';

$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n";


