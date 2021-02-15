<?php

namespace App\Models;

use App\Models\ApiModel;
use App\Models\Params;
use Illuminate\Http\Request;

class WebApp extends ApiModel
{

    protected $table = 'apps';

    protected $primaryKey = 'app_id';

    protected $casts = [
        'enabled' => 'boolean',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'app',
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
     * True, если это app по умолчанию
     * @return bool
     */
    public function isDefault()
    {
        return ($this->app_id == $this->getDefault());
    }

    /**
     * Вернуть app_id по умолчанию
     * @return int
     */
    public static function getDefault()
    {
        return Params::get('app_default');
    }

    /**
     * Установить app по умолчанию
     * @param int $group_id
     */
    public function setDefault($app_id = null)
    {
        $app_id = $app_id ?? $this->app_id;
        Params::set('app_default', $app_id);
    }

}
