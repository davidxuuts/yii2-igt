<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 4:33 PM
 */

namespace davidxu\igt\core;


use davidxu\igt\protobuf\PBMessage;

class SingleBatchItem extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->fields["1"] = "PBInt";
        $this->values["1"] = "";
        $this->fields["2"] = "PBString";
        $this->values["2"] = "";
    }

    function seqId()
    {
        return $this->_get_value("1");
    }

    function set_seqId($value)
    {
        return $this->_set_value("1", $value);
    }

    function data()
    {
        return $this->_get_value("2");
    }

    function set_data($value)
    {
        return $this->_set_value("2", $value);
    }
}