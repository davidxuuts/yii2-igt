<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 12:28 PM
 */

namespace davidxu\igt\utils;


class AppConditions
{
    //手机类型
    const PHONE_TYPE = "phoneType";
    //地区
    const REGION = "region";
    //自定义tag
    const TAG = "tag";

    //条件
    var $condition = [];

    function __call ($name, $args )
    {
        if ($name == 'addCondition') {
            switch (count($args)) {
                case 2:
                    return call_user_func_array(array($this, 'addCondition2'), $args);
                case 3:
                    return call_user_func_array(array($this, 'addCondition3'), $args);
            }
        }
    }

    function addCondition3($key, $values, $optType = 0) {
        $item = [];
        $item["key"] = $key;
        $item["values"] = $values;
        $item["optType"] = $optType;
        $this -> condition[] = $item;
        return $this;
    }

    function addCondition2($key, $values) {
        return $this->addCondition3($key, $values, 0);
    }

    function getCondition() {
        return $this->condition;
    }
}