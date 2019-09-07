<?php

namespace App\Helpers;

class Traffic
{
	private function curl_post_request($url, $data) 
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}

	public static function locationCountry($ip)
	{
		$postData = array(
			"user-id" => env('NEUTRINO_USER_ID'),
			"api-key" => env('NEUTRINO_API_KEY'),
			"ip" => $ip
		);

		$json = $this->curl_post_request("https://neutrinoapi.com/ip-info", $postData); 
		$result = json_decode($json, true);
		return $result['country'];
	}
}
