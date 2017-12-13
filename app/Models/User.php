<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * 防止用户随意修改模型数据，只有在此属性里定义的字段，才允许修改，否则忽略
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 一个用户拥有多个话题
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }


    // 在策略里避免代码的重复性
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }
}
