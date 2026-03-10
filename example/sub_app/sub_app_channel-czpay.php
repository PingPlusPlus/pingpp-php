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
$sub_app_channel = \Pingpp\Channel::create('app_mXPSm5rjXHa5DS8i', [
    'channel' => 'czpay',
    'params' => [
        'czpay_merchant_id' => '3E262B6F73D84FBF949176DC45FB0AAF',
        'czpay_split_merchant_id' => 'test20210415',
        'czpay_secret_key' => 'bh/JLn7L7JbYyD9g',
        'czpay_public_key' => '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzSc+LkEWs3GS7KR1+QbA
FUQ9vxHUQvtjmWlW+bAhkAOwIIrhFrh+i7vqbHRmRBJM74N801jXXfr1ftqqDqzI
nvSn93RrPjd2Er1KyLmorQhpRthh3HnR6N+0lE+NfGjsIhltdCqn8dY69idLgJ+i
vBpqFluXO2UlcuzBXs+otGEyVq2ER90NmnFjs0vI0JJX7uebBDUfbu88Aq/oOnzH
U3KcvLd2za7xFRdTFL2YBWh60+Ylx9/MDUGO4Hzkb9eUeYWkEZIG8xf7puIO8XKM
wE6Xxnxq/zKV5hx6/fVAhWcF/Q3ne2cesgLIAl4zh6Omba+nmYzS5WiVxTHuhmJo
3QIDAQAB
-----END PUBLIC KEY-----',
        'czpay_private_key' => "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDNJz4uQRazcZLs
pHX5BsAVRD2/EdRC+2OZaVb5sCGQA7AgiuEWuH6Lu+psdGZEEkzvg3zTWNdd+vV+
2qoOrMie9Kf3dGs+N3YSvUrIuaitCGlG2GHcedHo37SUT418aOwiGW10Kqfx1jr2
J0uAn6K8GmoWW5c7ZSVy7MFez6i0YTJWrYRH3Q2acWOzS8jQklfu55sENR9u7zwC
r+g6fMdTcpy8t3bNrvEVF1MUvZgFaHrT5iXH38wNQY7gfORv15R5haQRkgbzF/um
4g7xcozATpfGfGr/MpXmHHr99UCFZwX9Ded7Zx6yAsgCXjOHo6Ztr6eZjNLlaJXF
Me6GYmjdAgMBAAECggEAG9D0V2Uv5MjDeR6beFZ3+Oo1zRBnzWU0jfqAdn5xLoux
d9gcyO3fCqdCE858h0JL+DXF2Qo0uWNrofWYFUFMOnFFzQGWAOuYMNZFq42w1zVK
wPZZ3oEN+xtJ6soWjwXS7pSwCI44E0xO1k1hqWD7ubGDLODiUoVWXIzJc0eIwlwl
H4zjaNSZleT6U6DgA4Qq1ReHu4BKFAWPmbyYGHRBKWUuQYRugQ5GlM3YqGEGJCK0
1v8JRp2yJDIW8VlmnbfzRvnWyAAag7unG4Z/qLz4m2sI+mKjln8kZ9DUR6qxYpDR
OJkeyauUYrsX3ig08HMfkDwXJBeUU4OUT55Nhc04QQKBgQD2CdQFezFgiw8noKm/
TI+p45YJAdaPs1V4FKxzH1wr17i3nCQvXkG3y/mzdJ7hQMSHmgLME1INyk+keTkr
a0nt2neKHH3RAPtV75LcPhLvXG4yBZb0eMynILm3ab/pYHwkyQtuHifU+t1sUPvF
ORg+Wr9Fq1s0qz4buMFxU+5h2QKBgQDVdaSwXBVWNuTZlb0SFu7ZVlPoshsaH8Cc
eyx8n7KukLCDYsJpGW/iew8PvrmFPYAGiXaO9HuDjRf4BH8Dbc5xeFxayHThTv0M
TRJgTJBDjSRRi8hshjRMBzVbkBbjLdey5QEqomENCLECO41TQ8SfHkzDaoOns+rB
Z1gVXXkYpQKBgQDEIz+fgv7w/Mp/B8hqlUkt4R1ZXtrCQe+Pw8NaHxTmapl53gLG
tDhlojkUQ5Lo9S32/+Lc90YBcledQXo+z8/myrNjKaVvOX4jmtITu3Ry1teODwCx
MZ/MV/1VZvszu9Qbqx3ukiGk2rwrvj+HkSVvh/5VNu6FhUIE7Xtgsc0muQKBgGOa
BUKVdQ9JhfdRO2vZb5HSCk0l7id+cW2Su+tayRFTSknEJ1rLF73iFeEO6ZoWXEqw
kbWatpdnmquLzYhYEGA5/T4PExqetMysmcp9b0NV9IBobRjWdkiThH44+bT/iwpa
ePTf19ExIQcdqpATqwdkKAV3Cf+SoBOmmR8/AmZRAoGAfg5NU6PMuzPutAAUTuer
pf+G821+uqVY7wCuWwZSyD6PKMZaciBsQau1JefUxXlQUdDk5LuNt2yxXX+syr92
6wtYYzu+YgnJv1t8QOeJLAucyWdZI1+wRCN+8gq+5BeqRh6Rnw+IBuoPra3lSijX
OghSJJ2UGPQbLIajEzFuFAg=
-----END PRIVATE KEY-----",
    ],
    'description' => 'czpay 钱包支付配置',
]);

//查询子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::retrieve('app_mXPSm5rjXHa5DS8i', 'czpay');
echo $sub_app_channel;

//更新子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::update('app_mXPSm5rjXHa5DS8i', 'czpay', [
    'description' => 'new description',
    'params' => [
        'czpay_merchant_id' => '3E262B6F73D84FBF949176DC45FB0AAF',
    ],
]);
echo $sub_app_channel;

//删除子商户应用支付渠道
$sub_app_channel = \Pingpp\Channel::delete('app_mXPSm5rjXHa5DS8i', 'czpay');
echo $sub_app_channel;
