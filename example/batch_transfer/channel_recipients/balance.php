<?php
return [
    [
        'user' => 'user_test_01',   //必填 接收者用户 ID。
        'amount' => 5000,   //必填 金额。
        'description' => 'Your description',  //不填默认使用外层参数中的 description,批量付款描述，最多 100 个 Unicode 字符。
        'order_no' => '88888888',   //可选 订单号， 1 ~ 64 位不能重复的数字字母组合。
    ],
    [
        'user' => 'user_test_02',
        'amount' => 3000,
        'description' => 'Your description',
        'order_no' => '88888889',
    ]
];