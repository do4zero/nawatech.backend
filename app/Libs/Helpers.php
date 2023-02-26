<?php

namespace App\Libs;

class Helpers
{
    static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function invoiceNumber() {
        $number = date('dmY').'-'.self::generateRandomString(4).'-'.date('His');
        return $number;
    }

    static function readfile($jsonfile){
        request()->file($jsonfile)->move(public_path('app'),$jsonfile.'.json');
        $file = file_get_contents(public_path('app').'/'.$jsonfile.'.json');
        return json_decode($file, true);
    }

    static function searchItems($array, $search, $key = 'code')
    {
       foreach ($array as $value) {
            if($search == $value[$key]){
                return $value;
            }
       }

       return [];
    }
}
