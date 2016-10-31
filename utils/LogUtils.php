<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 30/10/2016
 * Time: 11:38 AM
 */

namespace davidxu\igt\utils;

class LogUtils
{
    static $debug = true;
    public static function debug($log)
    {
        if (self::$debug)
            echo date('y-m-d h:i:s',time()) . ($log) . "\r\n";
    }
}