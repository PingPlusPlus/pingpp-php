<?php
return [
    // 必须，手机号码。
    'phone' => 'your phone',

    // 可选，交易完成跳转的地址。
    'return_url' => 'http://example.com/success',

    // 可选，分期参数，0 代表不分期，1 代表分 3 期，2 代表分 6 期，3 代表分 9 期，4 代表分 12 期。
    'term' => 0,

    // 可选，账户激活中状态跳转链接。
    'activate_url' => 'http://example.com/activate_url',

    // 可选，是否显示量化派页面顶部 header，即是否显示 H5 顶部标题栏，默认为  true 时显示。
    'has_header' => true,
];