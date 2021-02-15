<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscribeController extends Controller
{
    private $subscribe;
    private $rubric;
    private $user;
    private $error;

    public function __construct()
    {
        //$this->middleware('api.format');
        //$this->middleware('api.session');
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Получить даные
     * @param Request $request
     * @return Response
     */
    public function subscribe_get(Request $request)
    {
        if ($this->loadSubscribe($request)) {
            return $this->responseInfo();
        }

        return $this->error;
    }

    /**
     * Добавить новую
     * @param Request $request
     * @return Response
     */
    public function subscribe_add(Request $request)
    {
        $this->validate($request, [
            'values' => 'array|required',
            'values.user_name' => 'string',
            'values.rubric' => 'string|lower|required_without_all:values.rubric_id',
            'values.rubric_id' => 'integer|required_without_all:values.rubric',
            'values.user' => 'string|lower|required_without_all:values.user_id,values.email',
            'values.user_id' => 'integer|required_without_all:values.user,values.email',
            'values.email' => 'email|required_without_all:values.user,values.user_id',
        ]);

        $values = $request->values;
        if ($this->loadRubric($values) && $this->loadUser($values)) {
            if (Subscribe::where([
                'rubric_id' => $this->rubric->rubric_id,
                'user_id' => $this->user->user_id,
            ])->exists()) {
                return response()->error('already', 'Subscribe already exists');
            }

            $this->subscribe = Subscribe::create([
                'rubric_id' => $this->rubric->rubric_id,
                'user_id' => $this->user->user_id,
                'user_name' => $values['user_name'],
            ]);

            return $this->responseInfo();
        }

        return $this->error;
    }

    /**
     * Установить новые значения
     * @param Request $request
     * @return Response
     */
    public function subscribe_set(Request $request)
    {
        $this->validate($request, [
            'values' => 'array|required',
            'values.user_name' => 'string',
        ]);

        if ($this->loadSubscribe($request)) {
            $values = $request->values;
            $this->subscribe->fill($values, ['user_name']);
            $this->subscribe->save();
            return $this->responseInfo();
        }

        return $this->error;
    }

    /**
     * Удалить
     * @param Request $request
     * @return Response
     */
    public function subscribe_delete(Request $request)
    {
        if ($this->loadSubscribe($request)) {
            return response()->success($this->subscribe->trash());
        }

        return $this->error;
    }

    /**
     * Получить список
     * @param Request $request
     * @return Response
     */
    public function subscribe_list(Request $request)
    {
        $this->validate($request, [
            'page_size' => 'integer|min:0|max:100|def:20',
            'page_num' => 'integer',
        ]);

        $page = Subscribe::page($request->page_size, $request->page_num);
        return response()->success($page);
    }

    /**
     * Вернуть список рубрик для пльзователя
     * @param Request $request
     * @return Response
     */
    public function subscribe_user_rubrics(Request $request)
    {
        $this->validate($request, [
            'user' => 'string|lower|required_without_all:user_id,email,subscribe_id',
            'user_id' => 'integer|required_without_all:user,email,subscribe_id',
            'email' => 'email|required_without_all:user,user_id,subscribe_id',
        ]);

        $data = $request->all();

        if ($this->LoadUser($data)) {
            $page = Rubric::rightJoin('subscribes', 'subscribes.rubric_id', '=', 'rubrics.rubric_id')
                ->where(['subscribes.user_id' => $this->user->user_id])
                ->select('rubrics.*')
                ->page($request->page_size, $request->page_num);
            return response()->success($page);

//            $page = Subscribe::where(['user_id' => $this->user->user_id])
//                ->withRubric('rubric_id,rubric,description')
//                ->page($request->page_size, $request->page_num);
//            return response()->success($page);
        }

        return $this->error;
    }

    /**
     * Отписаться от всех рубрик для пользователя
     * @param Request $request
     * @return Response
     */
    public function subscribe_user_clear(Request $request)
    {
        $this->validate($request, [
            'user' => 'string|lower|required_without_all:user_id,email,subscribe_id',
            'user_id' => 'integer|required_without_all:user,email,subscribe_id',
            'email' => 'email|required_without_all:user,user_id,subscribe_id',
        ]);

        $data = $request->all();

        if ($this->LoadUser($data)) {
            $count = Subscribe::where(['user_id' => $this->user->user_id])->delete();
            return response()->success($count);
        }

        return $this->error;
    }

    /**
     * Вернуть список подписчиков рубрики
     * @param Request $request
     * @return Response
     */
    public function subscribe_rubric_users(Request $request)
    {
        $this->validate($request, [
            'rubric' => 'string|lower|required_without_all:rubric_id',
            'rubric_id' => 'integer|required_without_all:rubric',
            'page_size' => 'integer|min:0|max:100|def:20',
            'page_num' => 'integer',
        ]);

        $data = $request->all();

        if ($this->LoadRubric($data)) {
            $page = User::rightJoin('subscribes', 'subscribes.user_id', '=', 'users.user_id')
                ->where(['subscribes.rubric_id' => $this->rubric->rubric_id])
                ->select('users.*')
                ->page($request->page_size, $request->page_num);
            return response()->success($page);

//            $page = Subscribe::where(['rubric_id' => $this->rubric->rubric_id])
//                ->withUser('email,user,user_id')
//                ->page($request->page_size, $request->page_num);
//             return response()->success($page);
        }

        return $this->error;
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Получить запись из таблицы
     * @param Request $request
     * @return bool
     */
    private function loadSubscribe(Request $request)
    {
        $this->validate($request, [
            'subscribe_id' => 'integer|required_without_all:rubric,rubric_id,user,user_id,email',
            'rubric' => 'string|lower|required_without_all:subscribe_id,rubric_id',
            'rubric_id' => 'integer|required_without_all:subscribe_id,rubric',
            'user' => 'string|lower|required_without_all:user_id,email,subscribe_id',
            'user_id' => 'integer|required_without_all:user,email,subscribe_id',
            'email' => 'email|required_without_all:user,user_id,subscribe_id',
        ]);

        $data = $request->all();

        if (isset($data['subscribe_id'])) {
            if ($this->subscribe = Subscribe::whereCase($data, ['subscribe_id'])->first()) {
                $this->rubric = $this->subscribe->rubric;
                $this->user = $this->subscribe->user;
                return true;
            };
            return $this->errorSubscribe();
        }

        if ($this->loadRubric($data) && $this->LoadUser($data)) {
            if ($this->subscribe = Subscribe::where([
                'rubric_id' => $this->rubric->rubric_id,
                'user_id' => $this->user->user_id])
                ->first()) {
                return true;
            }
            return $this->errorSubscribe();
        }
    }

    /**
     * @param array $attributes
     * @return bool
     */
    private function loadRubric($attributes)
    {
        if ($this->rubric = Rubric::whereCase($attributes, ['rubric', 'rubric_id'])->first()) {
            return true;
        }
        return $this->errorRubric();
    }

    /**
     * @param array $attributes
     * @return bool
     */
    private function loadUser($attributes)
    {
        if ($this->user = User::whereCase($attributes, ['email', 'user', 'user_id'])->first()) {
            return true;
        }
        return $this->errorUser();
    }

    /**
     * @param array $attributes
     * @return bool
     */
    private function errorSubscribe()
    {
        $this->error = response()->error('not_found', 'Subscribe not found');
        return false;
    }

    private function errorRubric()
    {
        $this->error = response()->error('not_found', 'Rubric not found');
        return false;
    }

    private function errorUser()
    {
        $this->error = response()->error('not_found', 'User not found');
        return false;
    }

    /**
     * @return Response
     */
    private function responseInfo()
    {
        $data = [
            'subscribe_id' => $this->subscribe->subscribe_id,
            'rubric_id' => $this->rubric->rubric_id,
            'rubric' => $this->rubric->rubric,
            'description' => $this->rubric->description,
            'email' => $this->user->email,
            'user' => $this->user->user,
            'user_id' => $this->user->user_id,
            'user_name' => $this->subscribe->user_name,
        ];
        return response()->success($data);
    }
}
