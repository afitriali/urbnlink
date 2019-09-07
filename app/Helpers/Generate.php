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

	public static function randomPassword(int $pw_length = 16)
	{
        $character_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890abcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
		$charset_length = strlen($character_set);
		$password = '';

		for ($i = 0; $i < $pw_length; $i++) {
			$password .= $character_set[rand(0, $charset_length - 1)];
		}

		return $password;
	}

    public static function decimalToBase(Int $int, Int $base)
    {
        if (($base > 62) && ($base < 2)) {
            throw new Exception('Calculate::base(Int $int, Int $base) - $base must be less than or equal to 62');
        }
        $character_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        $current = $int % $base;
        $result = $character_set[$current];
        $partition = floor($int/$base);
        # while there are still positive integers to divide
        while ($partition) {
            $current = $partition % $base;
            $result = $character_set[$current] . $result;
            $partition = floor($partition/$base);
        }
        return $result;
    }
}
