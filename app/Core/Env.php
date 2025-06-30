<?php

namespace App\Core;

/** 
 * en el archivo .env se pueden definir variables de entorno
 * que pueden ser utilizadas en la aplicación.
 * @package App\Core
 * @author Joc Duarte
 */

class Env
{
    public static function load(string $path): void
    {
        if (!file_exists($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) continue;
            [$key, $value] = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}
