<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 2:39 PM
 */

namespace davidxu\igt\core;

class SimpleAlertMsg implements ApnMsg
{
    var $alertMsg;

    public function get_alertMsg()
    {
        return $this->alertMsg;
    }
}