<?php
defined("BASEPATH") OR exit("No direct script access allowed");

function calculate_date_in_milliseconds($date){
	$date_formatted = DateTime::createFromFormat(
		'd-m-Y H:i:s',
		$date,
		new DateTimeZone('UTC')
	);

	if($date_formatted === false){
		return -1;
	}

	return $date_formatted->getTimeStamp() * 1000;
}

function convert_to_full_hour_format($hr){
	$x = $hr * 3600;
	$y = fmod($x, 3600);

	$hour = floor($x / 3600);
	$min = floor($y / 60);
	$sec = round(fmod($y, 60));

	return ($hour < 10 ? "0".$hour : $hour).":".($min < 10 ? "0".$min : $min).":".($sec < 10 ? "0".$sec : $sec);
}

function calculate_mars_date($date_in_milliseconds){
	$julian_date_ut = 2440587.5 + ($date_in_milliseconds / (8.64 * pow(10, 7)));
	$julian_date_tt = $julian_date_ut + (37 + 32.184) / 86400;
	$delta_j2000 = $julian_date_tt - 2451545.0;

	return strval(((($delta_j2000 - 4.5) / 1.027491252) + 44796.0 - 0.00096));
}

function calculate_mars_time($date_in_milliseconds){
	$mars_date = calculate_mars_date($date_in_milliseconds);
	$mars_time = fmod((24 * $mars_date), 24);

	return convert_to_full_hour_format($mars_time);
}
