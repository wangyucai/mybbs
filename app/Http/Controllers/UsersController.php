<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    // 当一个类对象被创建之前该方法将会被调用
    // 使用 Laravel 提供身份验证（Auth）中间件(Middleware)来过滤未登录用户的 edit, update 动作
    public function __construct()
    {
        //middleware方法参数：第一个为中间件的名称，第二个为要进行过滤的动作
        // 通过 except 方法来设定 指定动作 不使用 Auth 中间件进行过滤，
        // 意为 —— 除了此处指定的动作以外，所有其他动作都必须登录用户才能访问，类似于黑名单的过滤机制。
        // 相反的还有 only 白名单方法，将只过滤指定动作。
        $this->middleware('auth', ['except' => ['show']]);
    }
    //显示用户个人信息页面
    public function show(User $user)
    {
        //检验用户是否授权
        // authorize 方法接收两个参数，第一个为授权策略的名称，第二个为进行授权验证的数据。
        $this->authorize('update', $user);
        return view('users.show',compact('user'));
    }

    // 显示编辑个人资料页面
    public function edit(User $user)
    {
      $this->authorize('update', $user);
      return view('users.edit',compact('user'));
    }

    // 处理 edit 页面提交的更改
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if($request->avatar){
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
