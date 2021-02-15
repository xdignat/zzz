<?php


namespace App\Http\Controllers;


use App\Helpers\ApiSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionController extends Controller
{
    public function __construct()
    {
        //$this->middleware('api.format');
    }

    /**
     * Открыть новую сессию
     * @param Request $request
     * @return Response
     */
    public function session_open(Request $request)
    {
        $this->validate($request, [
            'user' => 'string|lower|required_without_all:email',
            'email' => 'email|required_without_all:user',
            'password' => 'string|required',
        ]);

        /** @var User $item */
        if ($item = User::whereCase($request->all(), ['user', 'email', 'user_id'])->first()) {
            if ($item->checkPassword($request->password)) {
                ApiSession::new(1, 0);
                return response()->success();
            }
            return ApiSession::responseError('password');
        }
        return ApiSession::responseError('user');
    }

    /**
     * Завершить сессию
     * @param Request $request
     * @return Response
     */
    public function session_close(Request $request)
    {
        ApiSession::close();
        return response()->success();
    }

    /**
     * Информация о сесии. Заодно её продлить.
     * @param Request $request
     * @return Response
     */
    public function session_info(Request $request)
    {
        $response = ApiSession::responseCheck();
        return $response ?? response()->success();
    }

}
