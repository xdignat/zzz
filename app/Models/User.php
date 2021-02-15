<?php

namespace App\Models;

use App\Models\ApiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class User extends ApiModel
{
    protected $primaryKey = 'user_id';

    protected $casts = [
        'enabled' => 'boolean',
        'deleted_at' => 'timestamp',
        'created_at'  => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected $fillable = [
        'user',
        'email',
        'name',
        'password',
        'enabled',
        'group_id',
    ];

    protected $hidden = [
        'password',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    public function setPassword($value)
    {
        if ($value) {
            $this->password = Hash::make($value);
        }
        return $this;
    }

    public function checkPassword($value)
    {
        return Hash::check($value, $this->password);
    }

    public function isRoot()
    {
        return $this->user == 'root';
    }

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'user_id', 'user_id');
    }
    public function rubrics()
    {
        return $this->belongsToMany(Rubric::class, 'subscribes', 'user_id', 'rubric_id');
    }

}
