<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 27/09/2016
 * Time: 11:18 AM
 */

namespace davidxu\igt;

/**
 * Exception represents a generic exception for all purposes.
 *
 * @author David Xu <davidxu.xu.uts@163.com>
 * @version 1.0
 */
class RequestException extends \Exception
{
    /**
     * @var string
     */

    var $requestId;

    public function __construct($requestId, $message, $e)
    {
        parent::__construct($message, $e);
        $this->requestId = $requestId;
    }
    public function getRequestId()
    {
        return $this->requestId;
    }
}
