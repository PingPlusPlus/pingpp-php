<?php
return [
    [
        // 必须，接收者支付宝账号。
        'account' => 'account01@alipay.com',

        // 必须，金额，单位为分。
        'amount' => 5000,

        // 必须，接收者姓名。
        'name' => '张三',

        // 可选，批量企业付款描述，最多 200 字节。
        // 'description' => '描述',

        // 可选，账户类型，alipay 2.0 渠道会用到此字段，取值范围： 1、ALIPAY_USERID：支付宝账号对应的支付宝唯一用户号。以2088开头的16位纯数字组成。 2、ALIPAY_LOGONID（默认值）：支付宝登录号，支持邮箱和手机号格式。
        // 'account_type' => 'ALIPAY_LOGONID',

        // 可选，订单号， 1 ~ 64 位不能重复的数字字母组合。
        // 'order_no' => '123456789'
    ],
    [
        'account' => 'account02@alipay.com',
        'amount'  => 3000,
        'name'    => '李四'
    ]
];