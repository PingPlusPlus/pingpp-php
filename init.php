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
require(__DIR__ . '/lib/Pingpp.php');

// Utilities
require(__DIR__ . '/lib/Util/Util.php');
require(__DIR__ . '/lib/Util/Set.php');
require(__DIR__ . '/lib/Util/RequestOptions.php');

// Errors
require(__DIR__ . '/lib/Error/Base.php');
require(__DIR__ . '/lib/Error/Api.php');
require(__DIR__ . '/lib/Error/ApiConnection.php');
require(__DIR__ . '/lib/Error/Authentication.php');
require(__DIR__ . '/lib/Error/InvalidRequest.php');
require(__DIR__ . '/lib/Error/RateLimit.php');
require(__DIR__ . '/lib/Error/Channel.php');

// Plumbing
require(__DIR__ . '/lib/JsonSerializable.php');
require(__DIR__ . '/lib/PingppObject.php');
require(__DIR__ . '/lib/ApiRequestor.php');
require(__DIR__ . '/lib/ApiResource.php');
require(__DIR__ . '/lib/SingletonApiResource.php');
require(__DIR__ . '/lib/AttachedObject.php');
require(__DIR__ . '/lib/Collection.php');
require(__DIR__ . '/lib/AppBase.php');
require(__DIR__ . '/lib/UserBase.php');

// Pingpp API Resources
require(__DIR__ . '/lib/Charge.php');
require(__DIR__ . '/lib/Refund.php');
require(__DIR__ . '/lib/RedEnvelope.php');
require(__DIR__ . '/lib/Event.php');
require(__DIR__ . '/lib/Transfer.php');
require(__DIR__ . '/lib/CardInfo.php');
require(__DIR__ . '/lib/BatchRefund.php');
require(__DIR__ . '/lib/BatchTransfer.php');
require(__DIR__ . '/lib/Customs.php');
require(__DIR__ . '/lib/Order.php');
require(__DIR__ . '/lib/OrderRefund.php');
require(__DIR__ . '/lib/User.php');
require(__DIR__ . '/lib/BalanceTransaction.php');
require(__DIR__ . '/lib/Withdrawal.php');
require(__DIR__ . '/lib/BatchWithdrawal.php');
require(__DIR__ . '/lib/Coupon.php');
require(__DIR__ . '/lib/CouponTemplate.php');
require(__DIR__ . '/lib/Royalty.php');
require(__DIR__ . '/lib/RoyaltySettlement.php');
require(__DIR__ . '/lib/RoyaltyTransaction.php');
require(__DIR__ . '/lib/SettleAccount.php');
require(__DIR__ . '/lib/SubApp.php');
require(__DIR__ . '/lib/Channel.php');
require(__DIR__ . '/lib/BalanceTransfer.php');
require(__DIR__ . '/lib/BalanceBonus.php');
require(__DIR__ . '/lib/BalanceSettlements.php');
require(__DIR__ . '/lib/Recharge.php');
require(__DIR__ . '/lib/RoyaltyTemplate.php');
require(__DIR__ . '/lib/Agreement.php');
require(__DIR__ .'/lib/SplitReceiver.php');
require(__DIR__ .'/lib/SplitProfit.php');
require(__DIR__ .'/lib/ProfitTransaction.php');
require(__DIR__ .'/lib/SubBank.php');
require(__DIR__ .'/lib/UserPic.php');
require(__DIR__ .'/lib/Contact.php');
// wx_pub OAuth 2.0 method
require(__DIR__ . '/lib/WxpubOAuth.php');
require(__DIR__ . '/lib/WxLiteOAuth.php');
