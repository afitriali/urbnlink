<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Exception;

class Generate
{
    public static function sprinkleRandomChar(string $str)
    {
        if (strlen($str) >= 2) {
            return Str::random(2) . substr($str, 0, -1) . Str::random(1) . substr($str, -1);
        }

        return $str;
    }

    private static function decimalToBase(Int $int)
    {
        $character_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$base = strlen($character_set);
		$result = '';

        # while there are still positive integers to divide
        while ($int) {
            $current = $int % $base;
            $result = $character_set[$current] . $result;
            $int = floor($int / $base);
        }

        return $result;
    }

	public static function slug(Int $int)
	{
		return Generate::sprinkleRandomChar(Generate::decimalToBase($int));	
	}

	public static function verificationToken(int $pw_length = 16)
	{
        $character_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=';
		$charset_length = strlen($character_set);
		$token = '';

		for ($i = 0; $i < $pw_length; $i++) {
			$password .= $character_set[rand(0, $charset_length - 1)];
		}

		return $token;
	}

}
