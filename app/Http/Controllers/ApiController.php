<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Реакция на неизвестный урл
     * @return Response
     */
    public function index()
    {
        return response()->error('method', 'undef method');
    }

    /**
     * Реакция на неизвестный урл
     * @return Response
     */
    public function undef($page)
    {
        return response()->error('method', "undef method: $page");
    }

    /**
     * Вернуть статус сервера
     * @return Response
     */
    public function status()
    {
        return response()->success();
    }

    public function test()
    {
        return response()->success(['test' => 123]);
    }
}
