<?php
/**
 * Created by PhpStorm.
 * User: David Xu
 * Date: 29/09/2016
 * Time: 9:32 AM
 */

namespace davidxu\igt\protobuf\reader;

use davidxu\igt\protobuf\encoding\Base128varint;

abstract class PBInputReader
{
    protected $base128;
    protected $pointer = 0;
    protected $string = '';

    public function __construct()
    {
        $this->base128 = new Base128varint(1);
    }

    /**
     * Gets the actual position of the point
     * @return int the pointer
     */
    public function get_pointer()
    {
        return $this->pointer;
    }

    /**
     * Add add to the pointer
     * @param int $add - int to add to the pointer
     */
    public function add_pointer($add)
    {
        $this->pointer += $add;
    }

    /**
     * Get the message from from to actual pointer
     * @param $from
     * @return string
     */
    public function get_message_from($from)
    {
        return substr($this->string, $from, $this->pointer - $from);
    }

    /**
     * Getting the next varint as decimal number
     */
    public abstract function next();
}