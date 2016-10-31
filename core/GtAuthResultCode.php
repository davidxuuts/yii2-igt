<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 6:37 PM
 */

namespace davidxu\igt\core;


use davidxu\igt\protobuf\type\PBEnum;

class GtAuthResultCode extends PBEnum
{
    const successed  = 0;
    const failed_noSign  = 1;
    const failed_noAppkey  = 2;
    const failed_noTimestamp  = 3;
    const failed_AuthIllegal  = 4;
    const redirect  = 5;
}