<?php

namespace App\Core;

class Translation {
    private static $translations = [];

    public static function load($lang) {
        if ($lang === 'fr_FR') {
            $filePath = dirname(__DIR__) . "/lang/$lang.php";
            if (file_exists($filePath)) {
                self::$translations = include $filePath;
            }
        }
    }

    public static function get($key) {
        return self::$translations[$key] ?? $key;
    }
}
