<?php
// 将当前请求的路由名称转换为 CSS 类名称，作用是允许我们针对某个页面做页面样式定制
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function make_excerpt($value, $length = 200)
{
    // strip_tags() 函数剥去字符串中的 HTML、XML 以及 PHP 的标签。
    // trim() 函数移除字符串两侧的空白字符或其他预定义字符
    // str_limit限制字串的字符数量。(Laravel里辅助函数)
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}
