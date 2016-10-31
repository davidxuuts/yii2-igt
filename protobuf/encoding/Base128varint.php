<?php
/**
 * Created by PhpStorm.
 * User: David Xu
 * Date: 29/09/2016
 * Time: 9:23 AM
 */

namespace davidxu\igt\protobuf\encoding;

/**
 * Class Base128varint
 * Base 128 varints - decodes and encodes base128 varints to/from decimal
 * @package davidxu\igt\protobuf
 */
class Base128varint
{
    // modus for output
    var $modus = 1;

    /**
     * @param int $modus - 1=Byte 2=String
     */
    public function __construct($modus)
    {
        $this->modus = $modus;
    }

    /**
     * Returns the base128 value of an dec value
     * @param $number - number as decimal
     * @return string
     */
    public function set_value($number)
    {
        $string = decbin($number);
        if (strlen($string) < 8) {
            $hexstring = dechex(bindec($string));
            if (strlen($hexstring) % 2 == 1)
                $hexstring = '0' . $hexstring;

            if ($this->modus == 1) {
                return $this->hex_to_str($hexstring);
            }
            return $hexstring;
        }

        // split it and insert the mb byte
        $string_array = [];
        $pre = '1';
        while (strlen($string) > 0) {
            if (strlen($string) < 8) {
                $string = substr('00000000', 0, 7 - strlen($string) % 7) . $string;
                $pre = '0';
            }
            $string_array[] = $pre . substr($string, strlen($string) - 7, 7);
            $string = substr($string, 0, strlen($string) - 7);
            $pre = '1';
            if ($string == '0000000') {
                break;
            }
        }

        $hexstring = '';
        foreach ($string_array as $string) {
            $hexstring .= sprintf('%02X', bindec($string));
        }

        // now format to hexstring in the right format
        if ($this->modus == 1) {
            return $this->hex_to_str($hexstring);
        }

        return $hexstring;
    }


    /**
     * Returns the dec value of an base128
     * @param string $string bstring
     * @return number the dec value of an base128
     */
    public function get_value($string)
    {
        // now just drop the msb and reorder it + parse it in own string
        $valuestring = '';
        $string_length = strlen($string);

        $i = 1;

        while ($string_length > $i) {
            // unset msb string and reorder it
            $valuestring = substr($string, $i, 7) . $valuestring;
            $i += 8;
        }

        // now interpret it
        return bindec($valuestring);
    }

    /**
     * Converts hex 2 ascii
     * @param string $hex the hex string
     * @return string
     */
    public function hex_to_str($hex)
    {
        $str = '';
        for($i = 0; $i < strlen($hex); $i += 2) {
            $str .= chr(hexdec(substr($hex, $i, 2)));
        }
        return $str;
    }
}