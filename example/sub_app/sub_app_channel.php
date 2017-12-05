<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

//创建子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::create('app_1Gqj58ynP0mHeX1q', [
    'channel' => 'alipay',
    'params' => [
        'fee_rate' => 60,
        'alipay_pid' => '2088501666666666',
        'alipay_account' => 'account@example.com',
        'alipay_security_key' => 'Your security_key',
        'alipay_mer_app_private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDSBOW3jdthyqSBMNJ8P+BQnfoKpL29BtvACW1gr8YhXh8EqpBU
nUDdQgi8uYnprXBbR5O1DVnIqLKG9loEn3Rc2iqpnj3M3nSShuVByjyJjQ+DAIG2
/cgJjGQknCLo0CKtuEIyD5xBKYVz3GLofLKqCNGDYdUIxwgaBBpssNIDGQIDAQAB
AoGBAKmzw1taiRawA9VQegRkKQF7ZXwMOjTvwcme1H74CYUU5MOEfzOgDbW7kgvN
cJ8dwlg/sh7uNsppZjif/4UUw5R7bSu33m1sIyglmKUYTU7Kw+ETVAPgwkQjJhek
V/pDr143vmchAblD4RqQZTneojTkvYgci4RkHHHIIZ8lClIBAkEA/nEyCKzl0gxU
LWMd0HKLctcwDu6NPWycffFzSg/+k1+h0GlSTp2E8J6DKOYnrlQYvK2/BnbFPfrb
EySi+7c86QJBANNOExrr7xl54JnlZxbXNDnNrql2brPk1DsV/3Lo3Tmt8NuVqiyo
hVE8Vs/CPRqTTSPoTV4TwSscB4Torlox9rECQB9tne+CY7TJPxCIIKOhsmXR/Kar
gpimtMG9tC7ewOQ1OMiEad06CbSq76p6m0YmLxQHJgRHYV+hf7Pin5sV7BkCQQC6
9KxAuJk/YC9R2r/AXL4vmoU8GLZP4lnIwWjXwaLiwryFfEEp7BywyINCpOgtWED7
UTEK2M2jl9QrSzfgQ66xAkBm2RI+8onm/4PVKtOt8tqLjfsFGMR3g0aUwgSbznc0
Xg9dfU+YUgqfQnyAQHt9jG3/SBdmIrYoWwb7TqJZLkZI
-----END RSA PRIVATE KEY-----',
        'alipay_app_public_key' => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDSBOW3jdthyqSBMNJ8P+BQnfoK
pL29BtvACW1gr8YhXh8EqpBUnUDdQgi8uYnprXBbR5O1DVnIqLKG9loEn3Rc2iqp
nj3M3nSShuVByjyJjQ+DAIG2/cgJjGQknCLo0CKtuEIyD5xBKYVz3GLofLKqCNGD
YdUIxwgaBBpssNIDGQIDAQAB
-----END PUBLIC KEY-----',
    ],
    'banned' => false,
    'banned_msg' => null,
    'description' => 'alipay description',
]);

echo $sub_app_channel;
exit;


//查询子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::retrieve('app_1Gqj58ynP0mHeX1q', 'alipay');
echo $sub_app_channel;

//更新子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::update('app_1Gqj58ynP0mHeX1q', 'alipay', [
    'description' => 'new description',
    'params' => [
        'fee_rate' => 50,
        'alipay_pid' => 'Your Alipay pid',
        'alipay_account' => 'account@example.com',
    ],
]);
echo $sub_app_channel;
exit;

//删除子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::delete('app_1Gqj58ynP0mHeX1q', 'alipay');
echo $sub_app_channel;
exit;