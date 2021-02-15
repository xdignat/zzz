<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ApiRequest
{
    public static function pathGet($path, $delimiter = '.')
    {
        $request = request();
        $data = $request->all();

        if (!is_array($path)) {
            $path = explode($delimiter, $path);
        }

        return self::array_get($data);
    }

    public static function pathSet($path, $value, $delimiter = '.')
    {
        $request = request();
        $data = $request->all();

        if (!is_array($path)) {
            $path = explode($delimiter, $path);
        }

        self::array_set($data, $path, $value);

        $request->replace($data);
    }

    public static function pathUnset($path, $delimiter = '.')
    {
        $request = request();
        $data = $request->all();

        if (!is_array($path)) {
            $path = explode($delimiter, $path);
        }

        self::array_unset($data, $path);

        $request->replace($data);
    }

    private static function array_get(&$array, $path)
    {
        $temp = &$array;
        foreach ($path as $key) {
            if (is_array($temp) && array_key_exists($key, $temp)) {
                $temp = &$temp[$key];
            } else {
                return;
            }
        }
        return $temp;
    }

    private static function array_set(&$array, $path, $value)
    {
        $temp = &$array;
        foreach ($path as $key) {
            $temp = &$temp[$key];
        }
        $temp = $value;
        unset($temp);
    }

    private static function array_unset(&$array, $path)
    {
        $key = array_shift($path);

        if (empty($path)) {
            unset($array[$key]);
        } else {
            self::array_unset($array[$key], $path);
        }
    }
}
