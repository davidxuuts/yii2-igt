<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 1:11 PM
 */

namespace davidxu\igt\core;

use davidxu\igt\protobuf\type\PBEnum;

class ActionChainSMSStatus extends PBEnum
{
    const unread  = 0;
    const read  = 1;
}