<?php

namespace App\utility;


class Utility
{
    public static function debug($data = ''){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public static function dd($data = ''){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

}