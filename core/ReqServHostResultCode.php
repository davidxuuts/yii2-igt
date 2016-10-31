<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 1:05 PM
 */

namespace davidxu\igt\core;

use davidxu\igt\protobuf\type\PBEnum;

class ReqServHostResultCode extends PBEnum
{
    const successed  = 0;
    const failed  = 1;
    const busy  = 2;
}