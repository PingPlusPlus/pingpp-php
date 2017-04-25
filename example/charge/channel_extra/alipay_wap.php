<?php
return [
    // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
    'success_url' => 'http://example.com/success',

    // 可选，支付取消的回调地址， app_pay 为true时，该字段无效，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
    'cancel_url' => 'http://example.com/cancel',

    // 可选，2016 年 6 月 16 日之前登录 Ping++ 管理平台填写支付宝手机网站的渠道参数的旧接口商户，需要更新接口时设置此参数值为true，6月16号后接入的新接口商户不需要设置该参数。
    //'new_version' => true,

    // 可选，是否使用支付宝客户端支付，该参数为true时，调用客户端支付。
    //'app_pay' => true,
];