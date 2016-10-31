<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 4:14 PM
 */

namespace davidxu\igt\protobuf\type;


use davidxu\igt\protobuf\PBMessage;

class PBBool extends PBInt
{
    var $wired_type = PBMessage::WIRED_VARINT;

    /**
     * Parses the message for this type
     *
     * @param array
     */
    public function ParseFromArray()
    {
        $this->value = $this->reader->next();
        $this->value = ($this->value != 0) ? 1 : 0;
    }
}