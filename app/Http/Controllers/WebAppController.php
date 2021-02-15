<?php

namespace App\Http\Controllers;

use App\Models\WebApp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebAppController extends Controller
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
    public function app_exist(Request $request)
    {
        $item = $this->getWebApp($request);

        return response()->success(isset($item));
    }

    /**
     * Получить даные группы
     * @param Request $request
     * @return Response
     */
    public function app_get(Request $request)
    {
        $item = $this->getWebApp($request);
        if ($item) {
            $item->default = $item->isDefault();
            return response()->success($item);
        }
        return $this->errorNotFound();
    }

    /**
     * Установить новые значения группы
     * @param Request $request
     * @return Response
     */
    public function app_set(Request $request)
    {
        $item = $this->getWebApp($request);

        if ($item) {
            $ignore = ',' . $item->app_id . ',app_id';

            $this->validate($request, [
                'values' => 'array|required',
                'values.app' => 'string|lower|min:3|unique:apps,app' . $ignore,
                'values.description' => 'string',
                'values.permissions' => 'array',
                'values.default' => 'boolean',
                'values.enabled' => 'boolean',
            ]);

            $values = $request->values;
            $item->fill($values, ['app', 'description', 'permissions', 'enabled']);
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
    public function app_add(Request $request)
    {
        $this->validate($request, [
            'values' => 'array|required',
            'values.app' => 'string|lower|min:3|required|unique:apps,app',
            'values.description' => 'string',
            'values.permissions' => 'array',
            'values.default' => 'boolean',
            'values.enabled' => 'boolean',
        ]);

        $values = $request->values;
        $item = WebApp::new($values, ['app', 'description', 'enabled', 'permissions']);

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
    public function app_delete(Request $request)
    {
        $item = $this->getWebApp($request);

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
    public function app_list(Request $request)
    {
        $this->validate($request, [
            'page_size' => 'integer|min:0|max:100|def:20',
            'page_num' => 'integer',
        ]);

        $page = WebApp::page($request->page_size, $request->page_num);
        return response()->success($page);
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Получить запись из таблицы
     * @param Request $request
     * @return WebApp
     */
    private function getWebApp(Request $request)
    {
        $this->validate($request, [
            'app' => 'string|lower|required_without:app_id|',
            'app_id' => 'integer|required_without:app',
        ]);

        return WebApp::whereCase($request->all(), ['app_id', 'app'])->first();
    }

    private function errorNotFound()
    {
        return response()->error('not_found', 'App not found');
    }
}
