<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 4:06 PM
 */

namespace davidxu\igt\protobuf\type;

use davidxu\igt\protobuf\PBMessage;

class PBScalar extends PBMessage
{
    /**
     * Set scalar value
     */
    public function set_value($value)
    {
        $this->value = $value;
    }

    /**
     * Get the scalar value
     */
    public function get_value()
    {
        return $this->value;
    }
}