<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('PingPP needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('PingPP needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('PingPP needs the Multibyte String PHP extension.');
}

// PingPP singleton
require(dirname(__FILE__) . '/PingPP/PingPP.php');

// Channel constants
require(dirname(__FILE__) . '/PingPP/Channel.php');

// Utilities
require(dirname(__FILE__) . '/PingPP/Util.php');
require(dirname(__FILE__) . '/PingPP/Util/Set.php');

// Errors
require(dirname(__FILE__) . '/PingPP/Error.php');
require(dirname(__FILE__) . '/PingPP/ApiError.php');
require(dirname(__FILE__) . '/PingPP/ApiConnectionError.php');
require(dirname(__FILE__) . '/PingPP/AuthenticationError.php');
require(dirname(__FILE__) . '/PingPP/InvalidRequestError.php');
require(dirname(__FILE__) . '/PingPP/RateLimitError.php');

// Plumbing
require(dirname(__FILE__) . '/PingPP/Object.php');
require(dirname(__FILE__) . '/PingPP/ApiRequestor.php');
require(dirname(__FILE__) . '/PingPP/ApiResource.php');
require(dirname(__FILE__) . '/PingPP/SingletonApiResource.php');
require(dirname(__FILE__) . '/PingPP/AttachedObject.php');
require(dirname(__FILE__) . '/PingPP/List.php');

// PingPP API Resources
require(dirname(__FILE__) . '/PingPP/Charge.php');
require(dirname(__FILE__) . '/PingPP/Refund.php');
