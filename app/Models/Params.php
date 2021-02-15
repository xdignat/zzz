<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Params
 * Сохранить/получить параметры в БД
 * @package App\Models
 */
class Params extends Model
{
    const NULL = 0;
    const STRING = 1;
    const INT = 2;
    const FLOAT = 3;
    const BOOL = 4;

    protected $primaryKey = 'param_id';

    protected $fillable = [
        'name',
        'value',
        'type',
    ];

    public $timestamps = false;

    /**
     * Получить значение параметра по имени
     * @param string $name
     * @return mixed
     */
    public static function get($name)
    {
        $item = static::whereName($name)->first();
        if ($item && $item->value) {
            switch ($item->type) {
                case self::INT:
                    return (int) $item->value;
                case self::FLOAT:
                    return (float) $item->value;
                case self::BOOL:
                    return (bool) $item->value;
            }
            return $item->value;
        }
    }

    /**
     * Сохранить значение параметра по имени
     * @param string $name
     * @param mixed $value
     * @return bool
     */
    public static function set($name, $value)
    {
        if (isset($name)) {
            if (is_null($value)) {
                static::whereName($name)->delete();
                return true;
            }
            if (is_string($value)) {
                static::setValue($name, $value, self::STRING);
                return true;
            }
            if (is_int($value)) {
                static::setValue($name, $value, self::INT);
                return true;
            }
            if (is_float($value)) {
                static::setValue($name, $value, self::FLOAT);
                return true;
            }
            if (is_bool($value)) {
                static::setValue($name, $value, self::BOOL);
                return true;
            }
        }
        return false;
    }

    private static function whereName($name)
    {
        return static::where(['name' => $name]);
    }

    private static function setValue($name, $value, $type)
    {
        static::updateOrCreate(['name' => $name], ['value' => $value, 'type' => $type]);
    }
}
