<?php

namespace App\Helpers;

class Traffic
{
	public static function locationCountry($ip)
	{
		$access_key = env('IP_STACK_API_KEY');
		$curl = curl_init('http://api.ipstack.com/'. $ip .'?access_key='. $access_key); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$json = curl_exec($curl);
		$json = json_decode($json, true);
		curl_close($curl);

		return $json['country_name'];
	}
}
