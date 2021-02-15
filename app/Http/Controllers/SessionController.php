<?php


namespace App\Http\Controllers;


use App\Helpers\ApiSession;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.format');
    }

    public function session_open(Request $request)
    {
        $this->validate($request, [
            'user' => 'string|lower|required_without_all:email',
            'email' => 'email|required_without_all:user',
            'password' => 'string|required',
        ]);

        if ($item = User::whereRequest($request)->first()) {
            if ($item->checkPassword($request->password)) {
                ApiSession::new(1, 0);
                return response()->success();
            }
            return ApiSession::responseError('password');
        }
        return ApiSession::responseError('user');
    }

    public function session_close(Request $request)
    {
        ApiSession::close();
        return response()->success();
    }

    public function session_info(Request $request)
    {
        $response = ApiSession::responseCheck();
        return $response ?? response()->success();
    }

}
