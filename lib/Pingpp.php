<?php

// Tested on PHP 5.2, 5.3

// This snippet (and some of the curl code) due to the Facebook SDK.
if (!function_exists('curl_init')) {
  throw new Exception('Pingpp needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('Pingpp needs the JSON PHP extension.');
}
if (!function_exists('mb_detect_encoding')) {
  throw new Exception('Pingpp needs the Multibyte String PHP extension.');
}

// Pingpp singleton
require(dirname(__FILE__) . '/Pingpp/Pingpp.php');

// Channel constants
require(dirname(__FILE__) . '/Pingpp/Channel.php');

// Utilities
require(dirname(__FILE__) . '/Pingpp/Util.php');
require(dirname(__FILE__) . '/Pingpp/Util/Set.php');

// Errors
require(dirname(__FILE__) . '/Pingpp/Error.php');
require(dirname(__FILE__) . '/Pingpp/ApiError.php');
require(dirname(__FILE__) . '/Pingpp/ApiConnectionError.php');
require(dirname(__FILE__) . '/Pingpp/AuthenticationError.php');
require(dirname(__FILE__) . '/Pingpp/InvalidRequestError.php');
require(dirname(__FILE__) . '/Pingpp/RateLimitError.php');

// Plumbing
require(dirname(__FILE__) . '/Pingpp/Object.php');
require(dirname(__FILE__) . '/Pingpp/ApiRequestor.php');
require(dirname(__FILE__) . '/Pingpp/ApiResource.php');
require(dirname(__FILE__) . '/Pingpp/SingletonApiResource.php');
require(dirname(__FILE__) . '/Pingpp/AttachedObject.php');
require(dirname(__FILE__) . '/Pingpp/List.php');

// Pingpp API Resources
require(dirname(__FILE__) . '/Pingpp/Charge.php');
require(dirname(__FILE__) . '/Pingpp/Refund.php');
