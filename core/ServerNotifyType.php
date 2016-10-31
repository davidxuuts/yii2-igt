<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 1:13 PM
 */

namespace davidxu\igt\core;


use davidxu\igt\protobuf\type\PBEnum;

class ServerNotifyType extends PBEnum
{
    const normal  = 0;
    const serverListChanged  = 1;
    const exception  = 2;
}