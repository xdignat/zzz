<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    public function __construct()
    {
        //$this->middleware('api.format');
        //$this->middleware('api.session');
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Проверить наличие группы
     * @param Request $request
     * @return Response
     */
    public function group_exist(Request $request)
    {
        $item = $this->getGroup($request);

        return response()->success(isset($item));
    }

    /**
     * Получить даные группы
     * @param Request $request
     * @return Response
     */
    public function group_get(Request $request)
    {
        $item = $this->getGroup($request);
        if ($item) {
            $item->default = $item->isDefault();
        }

        if ($item) {
            return response()->success($item);
        }

        return $this->errorNotFound();
    }

    /**
     * Установить новые значения группы
     * @param Request $request
     * @return Response
     */
    public function group_set(Request $request)
    {
        $item = $this->getGroup($request);

        if ($item) {
            $ignore = ',' . $item->group_id . ',group_id';

            $this->validate($request, [
                'values' => 'array|required',
                'values.group' => 'string|lower|min:3|unique:groups,group' . $ignore,
                'values.description' => 'string',
                'values.permissions' => 'array',
                'values.default' => 'boolean',
                'values.enabled' => 'boolean',
            ]);

            $values = $request->values;
            $item->fill($values, ['group', 'description', 'permissions', 'enabled']);
            $item->save();

            if (isset($values['default'])) {
                $item->setDefault();
            }
            $item->default = $item->isDefault();

            return response()->success($item);
        };

        return $this->errorNotFound();
    }

    /**
     * Добавить новую группу
     * @param Request $request
     * @return Response
     */
    public function group_add(Request $request)
    {
        $this->validate($request, [
            'values' => 'array|required',
            'values.group' => 'string|lower|min:3|required|unique:groups,group',
            'values.description' => 'string',
            'values.permissions' => 'array',
            'values.default' => 'boolean',
            'values.enabled' => 'boolean',
        ]);

        $values = $request->values;
        $item = Group::new($values, ['group', 'description', 'enabled', 'permissions']);

        if (isset($values['default'])) {
            $item->setDefault();
        }

        $item->default = $item->isDefault();

        return response()->success($item);
    }

    /**
     * Удалить группу
     * @param Request $request
     * @return Response
     */
    public function group_delete(Request $request)
    {
        $item = $this->getGroup($request);

        if ($item) {
            return response()->success($item->trash());
        };

        return $this->errorNotFound();
    }

    /**
     * Получить список групп
     * @param Request $request
     * @return mixed
     */
    public function group_list(Request $request)
    {
        $this->validate($request, [
            'page_size' => 'integer|min:0|max:100|def:20',
            'page_num' => 'integer',
        ]);

        $page = Group::page($request->page_size, $request->page_num);
        return response()->success($page);
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Получить запись из таблицы
     * @param Request $request
     * @return Group
     */
    private function getGroup(Request $request)
    {
        $this->validate($request, [
            'group' => 'string|lower|required_without:group_id|',
            'group_id' => 'integer|required_without:group',
        ]);

        return Group::whereCase($request->all(), ['group_id', 'group'])->first();
    }

    private function errorNotFound()
    {
        return response()->error('not_found', 'Group not found');
    }
}
