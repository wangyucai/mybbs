<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
		// $topics = Topic::paginate(30);
    // 预加载
    // 方法 with() 提前加载了我们后面需要用到的关联属性 user 和 category，并做了缓存。
    // 后面即使是在遍历数据时使用到这两个关联属性，数据已经被预加载并缓存，因此不会再产生多余的 SQL 查询
    // $topics = Topic::with('user', 'category')->paginate(30);
    $topics = $topic->withOrder($request->order)->paginate(20);
		return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
    // 获取所有分类
    $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
    // fill 方法会将传参的键值数组填充到模型的属性中，如以上数组，$topic->title 的值为 标题；
    $topic->fill($request->all());
    // Auth::id() 获取到的是当前登录的 ID；
    $topic->user_id = Auth::id();
    // 保存到数据库中
		$topic->save();
    return redirect()->route('topics.show', $topic->id)->with('success', '成功创建主题！');
	}

	public function edit(Topic $topic)
	{
    $this->authorize('update', $topic);
    $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
	}

	public function destroy(Topic $topic)
	{
    
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '成功删除！');
	}

  public function uploadImage(Request $request, ImageUploadHandler $uploader)
  {
      // 初始化返回数据，默认是失败的
      $data = [
          'success'   => false,
          'msg'       => '上传失败!',
          'file_path' => ''
      ];
      // 判断是否有上传文件，并赋值给 $file
      if ($file = $request->upload_file) {
          // 保存图片到本地
          $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
          // 图片保存成功的话
          if ($result) {
              $data['file_path'] = $result['path'];
              $data['msg']       = "上传成功!";
              $data['success']   = true;
          }
      }
      return $data;
  }
}
