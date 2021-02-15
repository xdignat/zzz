<?php

namespace App\Providers;

use App\Helpers\ApiValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\Response;
use App\Helpers\ApiResponse;
use App\Helpers\ApiRequest;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($value = null, $status = 200, $headers = []) {
            return ApiResponse::success($value, $status, $headers);
        });

        Response::macro('error', function ($error, $message = null, $status = 400, $headers = []) {
            return ApiResponse::error($error, $message, $status, $headers);
        });

        Response::macro('except', function ($except, $status = 400, $headers = []) {
            return ApiResponse::except($except, $status, $headers);
        });

        ApiValidator::register();
//        // валидация-модификатор: подставляет значение по умолчанию
//        Validator::extendImplicit('def', function ($attribute, $value, $parameters, $validator) {
//            if (!isset($parameters[0])) {
//                return false;
//            }
//            if (!isset($value)) {
//                ApiRequest::pathSet($attribute, $parameters[0]);
//            }
//            return true;
//        });
//
//        // валидация-модификатор: переводит строку в нижний регистр
//        Validator::extend('lower', function ($attribute, $value, $parameters, $validator) {
//            ApiRequest::pathSet($attribute, strtolower($value));
//            return true;
//        });
    }

}
