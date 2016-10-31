<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 12:30 PM
 */

namespace davidxu\igt\utils;

class ApiUrlRespectUtils
{
    static $appkeyAndFasterHost = [];
    static $appKeyAndHost = [];
    static $appkeyAndLastExecuteTime = [];

    public static function getFastest($appkey, $hosts)
    {
        if ($hosts == null || count($hosts) == 0) {
            throw new \Exception("Hosts cann't be null or size must greater than 0");
        }

        if(isset(self::$appkeyAndFasterHost[$appkey]) && count(array_diff($hosts, isset(self::$appKeyAndHost[$appkey]) ? self::$appKeyAndHost[$appkey] : null)) == 0) {
            return self::$appkeyAndFasterHost[$appkey];
        } else {
            $fastest = self::getFastestRealTime($hosts);
            self::$appKeyAndHost[$appkey] = $hosts;
            self::$appkeyAndFasterHost[$appkey] = $fastest;
            return $fastest;
        }
    }

    public static function getFastestRealTime($hosts)
    {
        $mint=60.0;
        $s_url="";
        for ($i=0; $i<count($hosts); $i++) {
            $start = array_sum(explode(" ", microtime()));
            try {
                $homepage = HttpManager::httpHead($hosts[$i]);
            } catch (\Exception $e) {
                echo($e);
            }
            $ends = array_sum(explode(" ",microtime()));
            $diff=$ends-$start;
            if ($mint > $diff) {
                $mint=$diff;
                $s_url=$hosts[$i];
            }
        }
        return $s_url;
    }
}