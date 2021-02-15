<?php

namespace App\Models;

use App\Models\ApiModel;
use Illuminate\Http\Request;

class Rubric extends ApiModel
{
    protected $primaryKey = 'rubric_id';

    protected $casts = [
        'enabled' => 'boolean',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'rubric',
        'description',
        'enabled',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    protected $dates = [
        'created_at',
        'created_at',
        'updated_at'
    ];

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'rubric_id', 'rubric_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'subscribes', 'rubric_id', 'user_id');
    }
}
