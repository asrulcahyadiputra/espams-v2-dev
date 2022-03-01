<?php
function format_bulan($params)
{
	if ($params == 1) {
		$result = "Januari";
	} elseif ($params == 2) {
		$result = "Februari";
	} elseif ($params == 3) {
		$result = "Maret";
	} elseif ($params == 4) {
		$result = "April";
	} elseif ($params == 5) {
		$result = "Mei";
	} elseif ($params == 6) {
		$result = "Juni";
	} elseif ($params == 7) {
		$result = "Juli";
	} elseif ($params == 8) {
		$result = "Agustus";
	} elseif ($params == 9) {
		$result = "September";
	} elseif ($params == 10) {
		$result = "Oktober";
	} elseif ($params == 11) {
		$result = "November";
	} elseif ($params == 12) {
		$result = "Desember";
	}
	return $result;
}
