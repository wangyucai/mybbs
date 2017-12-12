<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    // category—— 一个话题属于一个分类；
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // user —— 一个话题拥有一个作者
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
