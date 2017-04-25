<?php
return [
    [
        // 必须，接收者银行卡账号。
        'account' => '656565656565656565656565',

        // 必须，金额，单位为分。
        'amount' => 5000,

        // 必须，接收者姓名。
        'name' => '张三',

        // 可选，批量企业付款描述，最多 200 字节。
        // 'description' => '描述',

        /**
         * open_bank_code 和 open_bank 两个参数必传一个，建议使用 open_bank_code ，若都传参则优先使用 open_bank_code 读取规则。
         * 具体值参考此链接：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E
         */

        // 条件可选，1~50位，开户银行。
        'open_bank' => '招商银行',

        // 条件可选，4位，开户银行编号。
        'open_bank_code' => '0308',

        // 可选，订单号， 1 ~ 16 位数字。
        // 'order_no' => '123456789'
    ],
    [
        'account'           => '656565656565656565656565',
        'amount'            => 3000,
        'name'              => '李四',
        'open_bank'         => '招商银行',
        'open_bank_code'    => '0308',
    ]
];