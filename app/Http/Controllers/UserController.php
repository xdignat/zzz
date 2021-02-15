<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Group;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('api.format');
        //$this->middleware('api.session');
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Проверить наличие пользователя
     * @param Request $request
     * @return Response
     */
    public function user_exist(Request $request)
    {
        $item = $this->getUser($request);

        return response()->success(isset($item));
    }

    /**
     * Получить данные пользователя
     * @param Request $request
     * @return Response
     */
    public function user_get(Request $request)
    {
        $item = $this->getUser($request);
        if ($item) {
            return response()->success($item);
        }
        return $this->errorNotFound();
    }

    /**
     * Установить данные пользователя
     * @param Request $request
     * @return Response
     */
    public function user_set(Request $request)
    {
        $item = $this->getUser($request);

        if ($item) {
            $ignore = ',' . $item->user_id . ',user_id';
            $this->validate($request, [
                'values' => 'array|required',
                'values.user' => 'string|lower|min:3|unique:users,user' . $ignore,
                'values.email' => 'email|unique:users,email' . $ignore,
                'values.enabled' => 'boolean',
                'values.password' => 'string|min:6|max:20',
                'values.group_id' => 'integer|exists:groups,group_id',
                'values.group' => 'string|exists:groups,group',
            ]);

            $values = $request->values;
            $group = Group::whereCase($values, ['group_id', 'group'])->first();
            if ($group) {
                $values['group_id'] = $group->group_id;
            }

            $item->fill($values, ['user', 'email', 'enabled', 'group_id']);
            $item->setPassword(@$values['password']);

            $item->save();

            return response()->success($item);
        };

        return $this->errorNotFound();
    }

    /**
     * Добавить нового пользователя
     * @param Request $request
     * @return Response
     */
    public function user_add(Request $request)
    {
        $this->validate($request, [
            'values' => 'array|required',
            'values.user' => 'string|lower|min:3|required|unique:users,user',
            'values.email' => 'email|required|unique:users,email',
            'values.enabled' => 'boolean',
            'values.password' => 'string|required|min:6|max:20',
            'values.group_id' => 'integer|exists:groups,group_id',
            'values.group' => 'string|exists:groups,group',
        ]);

        $values = $request->values;

        if (!isset($values['group_id'])) {
            $group = Group::whereCase($values, ['group'])->first();
            $values['group_id'] = ($group) ? $group->group_id : Group::getDefault();
        }

        $item = User::new($values, ['user', 'email', 'enabled', 'group_id']);
        $item->setPassword($values['password']);
        $item->save();

        return response()->success($item);
    }

    /**
     * Удалить пользователя
     * @param Request $request
     * @return Response
     */
    public function user_delete(Request $request)
    {
        $item = $this->getUser($request);

        if ($item) {
            return response()->success($item->trash());
        };

        return $this->errorNotFound();
    }

    /**
     * Вернуть список пользователей
     * @param Request $request
     * @return Response
     */
    public function user_list(Request $request)
    {
        $this->validate($request, [
            'page_size' => 'integer|min:0|max:100|def:20',
            'page_num' => 'integer',
        ]);

        $page = User::page($request->page_size, $request->page_num);
        return response()->success($page);
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Получить запись из таблицы
     * @param Request $request
     * @return User
     */
    private function getUser(Request $request)
    {
        $this->validate($request, [
            'user' => 'string|lower|required_without_all:user_id,email',
            'user_id' => 'integer|required_without_all:user,email',
            'email' => 'email|required_without_all:user,user_id',
        ]);

        return User::whereCase($request->all(), ['user_id', 'user', 'email'])->first();
    }

    private function errorNotFound()
    {
        return response()->error('not_found', 'User not found');
    }
}
