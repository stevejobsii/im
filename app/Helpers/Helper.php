<?php
if (! function_exists('test_function')) {
    function test_function() {
        echo "我是一个自定义辅助函数";
    }
}

/**
 * 判断是否为空
 */
function isNullOrEmpty($obj) {
    if(!$obj instanceof Illuminate\Database\Eloquent\Collection) {
        return (!isset($obj) || empty($obj) || $obj == null);
    } else {
        return $obj->isEmpty();
    }
}

function lang($text, $parameters = [])
{
    return str_replace('imall.', '', trans('imall.'.$text, $parameters));
}