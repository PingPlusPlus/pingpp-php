<?php
return [
    // 可选，指定支付方式，指定不能使用信用卡支付可设置为 no_credit 。
    'limit_pay' => 'no_credit',

    // 可选，商品标记，代金券或立减优惠功能的参数。
    //'goods_tag' => 'your goods_tag',

    // 必须，商品 ID，1-32 位字符串。此 id 为二维码中包含的商品 ID，商户可自定义。
    'product_id' => 'your product id',
];