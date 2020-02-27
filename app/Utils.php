<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utils extends Model

{
    static function notifyDev($message, $mode = 'email')
    {
//        Used to communicate issues to developers. Set developer contact on .env
        if ($mode == 'sms') {
            $phone_numbers = [env('DEVELOPER_MOBILE', '07224755556')];
            self::sms($message, $phone_numbers);
        } else {
            $email_addresses = [env('DEVELOPER_EMAIL', 'mrtncornel@gmail.com')];
            self::email($message, $email_addresses);
        }
        return true;
    }

    public static function randomColor()
    {
        return self::random_color();
    }

    /*
     * Supporting functions
     */
    static function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    static function random_color()
    {
        return '#' . self::random_color_part() . self::random_color_part() . self::random_color_part();
    }

    static function random_string($len = 5, $case = "m")
    {
        $string = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($len / strlen($x)))), 1, $len);
        switch ($case) {
            case "l":
                return strtolower($string);
            case "u":
                return strtoupper($string);
            default:
                return $string;
        }
    }

    static function randLetter()
    {
        return chr(97 + mt_rand(0, 25));
    }

    public static function sms($message, array $phone_numbers, $from=1)
    {
//        Used to send out SMS using Africa's talking
        foreach ($phone_numbers as $phone_number) {
            Sms::create([
                'user_id'=>$from,
                'phone_number' => $phone_number,
                'message' => $message
            ]);
//            todo the AT thing sending sms
        }
        return true;
    }

    public static function email($message, array $email_addresses)
    {
//        todo sending emails
        return true;
    }

    public static function humanReadableDuration($seconds) {
        $hms = gmdate("H:i:s", $seconds);
        $hours = intval(explode(':', $hms)[0]);
        $minutes = intval(explode(':', $hms)[1]);
        $seconds = intval(explode(':', $hms)[2]);
        $time_text = "";
        if ($hours > 0) {
            $time_text .="{$hours}h";
        }
        if ($minutes > 0) {
            $time_text .=" {$minutes}m";
        }
        if ($seconds > 0) {
            $time_text .=" {$seconds}s";
        }
        return $time_text;
    }

    public static function getWords($count=1) {
        $file = "public/words.txt";
        $file_arr = file($file);
//        $num_lines = count($file_arr);
//        $last_arr_index = $num_lines - 1;

        $words = "";

        while ($count > 0) {
            $random_line = explode(' ', $file_arr[array_rand($file_arr)]);
            $random_word_in_line = $random_line[array_rand($random_line)];
            $words .= "$random_word_in_line ";
            $count--;
        }
        return $words;
    }
}
