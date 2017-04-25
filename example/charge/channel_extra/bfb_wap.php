<?php
return [
    // 必须，支付成功的回调地址，在本地测试不要写 localhost ，请写 127.0.0.1。URL 后面不要加自定义参数。
    'result_url' => 'http://example.com/success',

    // 必须，是否需要登录百度钱包来进行支付。
    'bfb_login' => true,
];