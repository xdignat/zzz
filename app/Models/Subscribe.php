<?php

namespace App\Models;

use App\Models\ApiModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Subscribe extends ApiModel
{
    protected $primaryKey = 'subscribe_id';

    protected $casts = [
        'enabled' => 'boolean',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'subscribe',
        'rubric_id',
        'user_id',
        'user_name',
    ];

    protected $dates = [
        'created_at',
        'created_at',
        'updated_at'
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    public function rubric()
    {
        return $this->hasOne(Rubric::class, 'rubric_id', 'rubric_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function scopeWithRubric(Builder $query, $cols)
    {
        return $query->whereHas('rubric', static function (Builder $query) {
            return $query->where(['enabled' => true]);
        })
            ->with('rubric:' . $cols);
    }
    public function scopeWithUser(Builder $query, $cols)
    {
        return $query->whereHas('user', static function (Builder $query) {
            return $query->where(['enabled' => true]);
        })
            ->with('user:' . $cols);
    }
}
