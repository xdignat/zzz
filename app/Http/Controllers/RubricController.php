<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RubricController extends Controller
{
    public function __construct()
    {
        //$this->middleware('api.format');
        //$this->middleware('api.session');
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Проверить наличие
     * @param Request $request
     * @return Response
     */
    public function rubric_exist(Request $request)
    {
        $item = $this->getRubric($request);

        return response()->success(isset($item));
    }

    /**
     * Получить даные
     * @param Request $request
     * @return Response
     */
    public function rubric_get(Request $request)
    {
        $item = $this->getRubric($request);
        if ($item) {
            return response()->success($item);
        }
        return $this->errorNotFound();
    }

    /**
     * Установить новые значения
     * @param Request $request
     * @return Response
     */
    public function rubric_set(Request $request)
    {
        $item = $this->getRubric($request);

        if ($item) {
            $ignore = ',' . $item->rubric_id . ',rubric_id';

            $this->validate($request, [
                'values' => 'array|required',
                'values.rubric' => 'string|lower|min:3|unique:rubrics,rubric' . $ignore,
                'values.description' => 'string',
                'values.enabled' => 'boolean',
            ]);

            $values = $request->values;
            $item->fill($values, ['rubric', 'description', 'enabled']);
            $item->save();

            return response()->success($item);
        };

        return $this->errorNotFound();
    }

    /**
     * Добавить новую
     * @param Request $request
     * @return Response
     */
    public function rubric_add(Request $request)
    {
        $this->validate($request, [
            'values' => 'array|required',
            'values.rubric' => 'string|lower|min:3|required|unique:rubrics,rubric',
            'values.description' => 'string',
            'values.enabled' => 'boolean',
        ]);

        $values = $request->values;
        $item = Rubric::new($values, ['rubric', 'description', 'enabled', 'permissions']);

        return response()->success($item);
    }

    /**
     * Удалить
     * @param Request $request
     * @return Response
     */
    public function rubric_delete(Request $request)
    {
        $item = $this->getRubric($request);

        if ($item) {
            return response()->success($item->trash());
        };

        return $this->errorNotFound();
    }

    /**
     * Получить список
     * @param Request $request
     * @return mixed
     */
    public function rubric_list(Request $request)
    {
        $this->validate($request, [
            'page_size' => 'integer|min:0|max:100|def:20',
            'page_num' => 'integer',
        ]);

        $page = Rubric::page($request->page_size, $request->page_num);
        return response()->success($page);
    }

    public function rubric_user(Request $request)
    {
        $item = $this->getRubric($request);
        if ($item) {
            return response()->success($item);
        }
        return $this->errorNotFound();
    }

    //----------------------------------------------------------------------------------------------------------------//

    /**
     * Получить запись из таблицы
     * @param Request $request
     * @return Rubric
     */
    private function getRubric(Request $request)
    {
        $this->validate($request, [
            'rubric' => 'string|lower|required_without:rubric_id',
            'rubric_id' => 'integer|required_without:rubric',
        ]);

        return Rubric::whereCase($request->all(), ['rubric_id', 'rubric'])->first();
    }

    private function errorNotFound()
    {
        return response()->error('not_found', 'Rubric not found');
    }
}
