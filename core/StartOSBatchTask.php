<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 29/09/2016
 * Time: 4:32 PM
 */

namespace davidxu\igt\core;


use davidxu\igt\protobuf\PBMessage;

class StartOSBatchTask extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->fields["1"] = "OSMessage";
        $this->values["1"] = "";
        $this->fields["2"] = "PBInt";
        $this->values["2"] = "";
    }

    function message()
    {
        return $this->_get_value("1");
    }

    function set_message($value)
    {
        return $this->_set_value("1", $value);
    }

    function expire()
    {
        return $this->_get_value("2");
    }

    function set_expire($value)
    {
        return $this->_set_value("2", $value);
    }
}