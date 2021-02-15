<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiRequest;

class ApiValidator
{
    /**
     * Зарегестрировать правила валидации
     */
    public static function register()
    {
        // валидация-модификатор: подставляет значение по умолчанию
        Validator::extendImplicit('def', function ($attribute, $value, $parameters, $validator) {
            if (!isset($parameters[0])) {
                return false;
            }
            if (!isset($value)) {
                ApiRequest::pathSet($attribute, $parameters[0]);
            }
            return true;
        });

        // валидация-модификатор: переводит строку в нижний регистр
        Validator::extend('lower', function ($attribute, $value, $parameters, $validator) {
            ApiRequest::pathSet($attribute, strtolower($value));
            return true;
        });
    }

    /**
     * Вернуть ответ на исключение при валидации параметров
     * @param Exception $exception
     * @return \Illuminate\Http\Response
     */
    public static function responseExcept(Exception $exception)
    {
        return ApiResponse::error('params', [
            'message' => $exception->getMessage(),
            'params' => $exception->errors(),
        ]);
    }
}
