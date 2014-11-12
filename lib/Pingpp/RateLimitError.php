<?php

class Pingpp_RateLimitError extends Pingpp_InvalidRequestError
{
    public function __construct($message, $param, $httpStatus=null,
        $httpBody=null, $jsonBody=null
    )
    {
        parent::__construct($message, $httpStatus, $httpBody, $jsonBody);
    }
}
