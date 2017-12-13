<?php

namespace App\Observers;

use App\Models\Topic;
// use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
  public function saving(Topic $topic)
  {
    // XSS 过滤
      $topic->body = clean($topic->body, 'user_topic_body');

      // 生成话题摘录
      $topic->excerpt = make_excerpt($topic->body);
  }

// 模型监控器的 saved() 方法对应 Eloquent 的 saved 事件，此事件发生在创建和编辑时、数据入库以后。
// 在 saved() 方法中调用，确保了我们在分发任务时，$topic->id 永远有值。
  public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }
}
