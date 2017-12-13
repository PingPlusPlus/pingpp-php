<?php
return [
    // 可选，指定支付方式，指定不能使用信用卡支付可设置为 no_credit 。
    'limit_pay' => 'no_credit',

    // 必填，商品 ID，1-32 位字符串。此 id 为二维码中包含的商品 ID，商户可自定义。
    'product_id' => 'your product id',

    // 必填，商品列表，字段解释：goods_name:商品名称，goods_num:数量。
    'goods_list' => [
        [
            'goods_name' => 'iPhone',
            'goods_num' => '1',
        ],
        [
            'goods_name' => 'iPad',
            'goods_num' => '2',
        ],
    ],
];