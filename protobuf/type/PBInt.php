<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 4:08 PM
 */

namespace davidxu\igt\protobuf\type;

use davidxu\igt\protobuf\PBMessage;

class PBInt extends PBScalar
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
    }

    /**
     * Serializes type
     * @param int $rec
     * @return string
     */
    public function SerializeToString($rec = -1)
    {
        // first byte is length byte
        $string = '';

        if ($rec > -1) {
            $string .= $this->base128->set_value($rec << 3 | $this->wired_type);
        }

        $value = $this->base128->set_value($this->value);
        $string .= $value;

        return $string;
    }
}