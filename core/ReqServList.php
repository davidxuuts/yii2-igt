<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 1:59 PM
 */

namespace davidxu\igt\core;

use davidxu\igt\protobuf\PBMessage;

class ReqServList extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;

    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = "PBString";
        $this->values["1"] = "";
        $this->fields["3"] = "PBInt";
        $this->values["3"] = "";
    }

    function seqId()
    {
        return $this->_get_value("1");
    }

    function set_seqId($value)
    {
        return $this->_set_value("1", $value);
    }

    function timestamp()
    {
        return $this->_get_value("3");
    }

    function set_timestamp($value)
    {
        return $this->_set_value("3", $value);
    }
}