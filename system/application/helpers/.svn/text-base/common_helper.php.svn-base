<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_current_date'))
{
	function get_current_gmdate($format,$gm_hour,$gm_min,$gm_sec)
	{
		$year=gmdate("Y");
		$month=gmdate("m");
		$day=gmdate("d");
		$hour=gmdate("H") +$gm_hour;
		$min=gmdate("i") + $gm_min;
		return date($format,mktime($hour,$min,$gm_sec,$month,$day,$year));
	}
	
	function csv_export($content,$filename)
	{
		header('Content-Disposition: attachment; filename='.$filename.'.csv');			
		print $content;
	}
}