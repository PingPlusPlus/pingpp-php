<?php
return [
    // 必须，支付完成的回调地址。
    'success_url' => 'http://example.com/success',

    // 必须，支付失败页面跳转路径。
    'fail_url' => 'http://example.com/fail',

    // 可选，用户交易令牌，用于识别用户信息，支付成功后会调用 success_url 返回给商户。商户可以记录这个  token 值，当用户再次支付的时候传入该  token ，用户无需再次输入银行卡信息，直接输入短信验证码进行支付。32 位字符串。
    //'token' => 'dsafadsfasdfadsjuyhfnhujkijunhaf',

    // 可选，订单类型，值为0表示实物商品订单，值为 1 代表虚拟商品订单，该参数默认值为 0 。
    'order_type' => 0,

    // 可选，设置是否通过手机端发起支付，值为  true 时调用手机 h5 支付页面，值为  false 时调用 PC 端支付页面，该参数默认值为  true 。
    'is_mobile' => true,

    // 可选，用户账号类型，取值只能为：BIZ。传参存在问题请参考 帮助中心：https://help.pingxx.com/article/1012535/。
    //'user_type' => 'BIZ',

    // 可选，商户的用户账号。传参存在问题请参考 帮助中心：https://help.pingxx.com/article/1012535/。
    //'user_id' => 'your user_id',
];