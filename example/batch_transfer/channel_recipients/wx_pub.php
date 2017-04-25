<?php
return [
    [
        // 必须，接收者 id，为用户在 wx_pub 下的 open_id。
        'open_id' => 'openidxxxxxxxxxxxx',

        // 必须，金额，单位为分。
        'amount' => 5000,

        // 可选，收款人姓名。当该参数为空，则不校验收款人姓名。
        // 'name' => '张三',

        // 可选，批量企业付款描述，最多 99 个英文和数字的组合或最多 33 个中文字符，不可以包含特殊字符。不填默认使用外层参数中的 description。
        // 'description' => '描述',

        // 可选，是否强制校验收款人姓名。布尔类型，仅当 name 参数不为空时该参数生效。
        // 'force_check' => false,

        // 可选，订单号， 1 ~ 32 位不能重复的数字字母组合。
        // 'order_no' => '123456789'
    ],
    [
        'open_id' => 'openidxxxxxxxxxxxx',
        'amount'  => 5000,
    ]
];