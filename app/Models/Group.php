<?php

namespace App\Models;

use App\Models\ApiModel;
use Illuminate\Http\Request;

class Group extends ApiModel
{
    protected $primaryKey = 'group_id';

    protected $casts = [
        'enabled' => 'boolean',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'group',
        'description',
        'enabled',
        'permissions',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    protected $dates = [
        'created_at',
        'created_at',
        'updated_at'
    ];

    /**
     * True, если это группа по умолчанию
     * @return bool
     */
    public function isDefault()
    {
        return ($this->group_id == $this->getDefault());
    }

    /**
     * Вернуть group_id Группы по умолчанию
     * @return int
     */
    public static function getDefault()
    {
        return Params::get('group_default');
    }

    /**
     * Установить группу по умолчанию
     * @param int $group_id
     */
    public function setDefault($group_id = null)
    {
        $group_id = $group_id ?? $this->group_id;
        Params::set('group_default', $group_id);
    }

}
