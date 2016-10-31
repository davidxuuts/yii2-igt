<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 1:08 PM
 */

namespace davidxu\igt\core;


use davidxu\igt\protobuf\type\PBEnum;

class EPushResult extends PBEnum
{
    const successed_online  = 0;
    const successed_offline  = 1;
    const successed_ignore  = 2;
    const failed  = 3;
    const busy  = 4;
    const success_startBatch  = 5;
    const success_endBatch  = 6;
}