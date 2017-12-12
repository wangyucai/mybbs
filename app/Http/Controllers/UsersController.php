<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //显示用户个人信息页面
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }
}
