<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        return response()->error('method', 'undef method');
    }

    public function undef($page)
    {
        return response()->error('method', "undef method: $page");
    }

    public function status()
    {
        return response()->success();
    }

    public function test()
    {
        return response()->success(['test' => 123]);
    }
}
