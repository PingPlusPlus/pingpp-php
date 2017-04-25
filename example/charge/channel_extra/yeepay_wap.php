<?php
return [
    // 必须，商品类别码，商品类别码参考链接 ：https://www.pingxx.com/api#%E6%98%93%E5%AE%9D%E6%94%AF%E4%BB%98%E5%95%86%E5%93%81%E7%B1%BB%E5%9E%8B%E7%A0%81 。
    'product_category' => '1',

    // 必须，用户标识,商户生成的用户账号唯一标识，最长 50 位字符串。
    'identity_id' => 'your identity_id',

    // 必须，用户标识类型，用户标识类型参考链接：https://www.pingxx.com/api#%E6%98%93%E5%AE%9D%E6%94%AF%E4%BB%98%E7%94%A8%E6%88%B7%E6%A0%87%E8%AF%86%E7%B1%BB%E5%9E%8B%E7%A0%81 。
    'identity_type' => 1,

    // 必须，终端类型，对应取值 0:IMEI, 1:MAC, 2:UUID, 3:other。
    'terminal_type' => 1,

    // 必须，终端 ID。
    'terminal_id' => 'your terminal_id',

    // 必须，用户使用的移动终端的 UserAgent 信息。
    'user_ua' => 'your user_ua',

    // 必须，前台通知地址。
    'result_url' => 'http://example.com/success',
];