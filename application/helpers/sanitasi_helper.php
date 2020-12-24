<?php
defined('BASEPATH') or exit('No direct script access allowed');
function cetak($str)
{
	echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}
