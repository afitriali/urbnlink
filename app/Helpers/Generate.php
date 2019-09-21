<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Exception;

class Generate
{
    private static function sprinkleRandomChar(string $str)
    {
        $chars = str_split($str);
        $generated = '';
        foreach ($chars as $key=>$char) {
            if ($key % 2 == 0) {
                $generated .= Str::random(1) . $char;
            } else {
                $generated .= $char;
            }
        }
        return $generated . Str::random(1);
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
