<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

/**
 * Базовая модель
 * Class ApiModel
 * @package App\Models
 */
class ApiModel extends Model
{
    /**
     * Удалить запись
     * @return bool
     */
    public function trash()
    {
        if ($this->original['deleted_at']) {
            return false;
        }
        $this->enabled = false;
        $this->deleted_at = $this->freshTimestampString();
        return $this->save();
    }

    public static function new(array $attribute, array $names = null)
    {
        $attribute = ($names) ? array_intersect_key($attribute, array_flip($names)) : $attribute;
        return static::create($attribute);
    }

    /**
     * Скопитровать значения в запись
     * @param array $values
     * @param array $names
     */
    public function setValues(array $values, array $names = null)
    {
        $names = $names ?? array_keys($this->original);
        foreach ($names as $name) {
            if (isset($values[$name])) {
                $this->attributes[$name] = $values[$name];
            }
        }
    }

    /**
     * Скопитровать значения в запись
     * @param array $attribute
     * @param array $names
     * @return $this
     */
    public function fill(array $attribute, array $names = null)
    {
        if ($names) {
            foreach ($names as $name) {
                if (isset($attribute[$name])) {
                    $this->setAttribute($name, $attribute[$name]);
                }
            }
        } else {
            parent::fill($attribute);
        }

        return $this;
    }

    /**
     * Скоптровать значения в запись из Request
     * @param Request $request
     * @param null $names
     */
    public function setRequest(Request $request, $names = null)
    {
        $this->setValues($request->values, $names);
    }

    /**
     * Вернуть данные, разбитые на страницы
     * @param int $pageSize
     * @param int $pageNum
     * @param array $columns
     * @return array
     */
    public static function page($pageSize = null, $pageNum = null, $columns = ['*'])
    {
        $pageSize = (int)$pageSize ?? 20;
        $pageNum = (int)$pageNum ?? 1;
        /** @var Paginator $paginator */
        $paginator = static::paginate($pageSize, $columns, 'page', $pageNum);

        $result = [
            'total' => $paginator->total(),
            'count' => $paginator->count(),
            'current' => $paginator->currentPage(),
            'size' => $paginator->perPage(),
            'items' => $paginator->items(),
        ];

        return $result;
    }

    public function scopePage(Builder $query, $pageSize = null, $pageNum = null, $columns = ['*'])
    {
        $pageSize = (int)$pageSize ?? 20;
        $pageNum = (int)$pageNum ?? 1;
        /** @var Paginator $paginator */
        $paginator = $query->paginate($pageSize, $columns, 'page', $pageNum);

        $result = [
            'total' => $paginator->total(),
            'count' => $paginator->count(),
            'current' => $paginator->currentPage(),
            'size' => $paginator->perPage(),
            'items' => $paginator->items(),
        ];

        return $result;
    }

    /**
     * Найти элемент, соответсвующий хотябы одному значению
     * @param array $values
     * @param array $names
     * @return \Illuminate\Support\Collection
     */
    public static function whereCase(array $values, $names = null)
    {
        foreach ((array)$names as $name) {
            if (isset($values[$name])) {
                return static::where($name, $values[$name]);
            }
        }

        return collect([]);
    }

}
