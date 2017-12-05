<?php

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
require(dirname(__FILE__) . '/lib/Pingpp.php');

// Utilities
require(dirname(__FILE__) . '/lib/Util/Util.php');
require(dirname(__FILE__) . '/lib/Util/Set.php');
require(dirname(__FILE__) . '/lib/Util/RequestOptions.php');

// Errors
require(dirname(__FILE__) . '/lib/Error/Base.php');
require(dirname(__FILE__) . '/lib/Error/Api.php');
require(dirname(__FILE__) . '/lib/Error/ApiConnection.php');
require(dirname(__FILE__) . '/lib/Error/Authentication.php');
require(dirname(__FILE__) . '/lib/Error/InvalidRequest.php');
require(dirname(__FILE__) . '/lib/Error/RateLimit.php');
require(dirname(__FILE__) . '/lib/Error/Channel.php');

// Plumbing
require(dirname(__FILE__) . '/lib/JsonSerializable.php');
require(dirname(__FILE__) . '/lib/PingppObject.php');
require(dirname(__FILE__) . '/lib/ApiRequestor.php');
require(dirname(__FILE__) . '/lib/ApiResource.php');
require(dirname(__FILE__) . '/lib/SingletonApiResource.php');
require(dirname(__FILE__) . '/lib/AttachedObject.php');
require(dirname(__FILE__) . '/lib/Collection.php');
require(dirname(__FILE__) . '/lib/AppBase.php');
require(dirname(__FILE__) . '/lib/UserBase.php');

// Pingpp API Resources
require(dirname(__FILE__) . '/lib/Charge.php');
require(dirname(__FILE__) . '/lib/Refund.php');
require(dirname(__FILE__) . '/lib/RedEnvelope.php');
require(dirname(__FILE__) . '/lib/Event.php');
require(dirname(__FILE__) . '/lib/Transfer.php');
require(dirname(__FILE__) . '/lib/Identification.php');
require(dirname(__FILE__) . '/lib/BatchRefund.php');
require(dirname(__FILE__) . '/lib/BatchTransfer.php');
require(dirname(__FILE__) . '/lib/Customs.php');
require(dirname(__FILE__) . '/lib/Order.php');
require(dirname(__FILE__) . '/lib/OrderRefund.php');
require(dirname(__FILE__) . '/lib/AssetTransaction.php');
require(dirname(__FILE__) . '/lib/User.php');
require(dirname(__FILE__) . '/lib/BalanceTransaction.php');
require(dirname(__FILE__) . '/lib/Withdrawal.php');
require(dirname(__FILE__) . '/lib/BatchWithdrawal.php');
require(dirname(__FILE__) . '/lib/Coupon.php');
require(dirname(__FILE__) . '/lib/CouponTemplate.php');
require(dirname(__FILE__) . '/lib/Royalty.php');
require(dirname(__FILE__) . '/lib/RoyaltySettlement.php');
require(dirname(__FILE__) . '/lib/RoyaltyTransaction.php');
require(dirname(__FILE__) . '/lib/SettleAccount.php');
require(dirname(__FILE__) . '/lib/SubApp.php');
require(dirname(__FILE__) . '/lib/Channel.php');
require(dirname(__FILE__) . '/lib/BalanceTransfer.php');
require(dirname(__FILE__) . '/lib/BalanceBonus.php');
require(dirname(__FILE__) . '/lib/Recharge.php');
require(dirname(__FILE__) . '/lib/RoyaltyTemplate.php');
// wx_pub OAuth 2.0 method
require(dirname(__FILE__) . '/lib/WxpubOAuth.php');


