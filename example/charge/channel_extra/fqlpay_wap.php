<?php
return [
    // 必须，子商户编号，需要提交该订单商户的所属子商户编号。
    'c_merch_id' => 'your c_merch_id',

    // 可选，前端回调地址，交易完成跳转的链接，不能带自定义参数。
    'return_url' => 'http://example.com/success',
];