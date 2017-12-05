<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

// 创建分润模板
try {
    $royalty_template = \Pingpp\RoyaltyTemplate::create(
        [
            'app' => \Pingpp\Pingpp::getAppId(),           //应用 ID
            'name' => 'royalty_template_name',             // 分润模板名称，允许中英文等常用字符
            'rule' => [
                'royalty_mode' => 'rate',                   //分润模式。分为按订单金额（包含优惠券金额）的比例 rate 和固定金额 fixed
                'refund_mode' => 'no_refund',               //退分润模式。分为退款时不退分润 no_refund、按比例退分润 proportional 和一旦退款分润全退 full_refund
                'allocation_mode' => 'receipt_reserved',    //分配模式。指当订单确定的层级如果少于模板配置层级时，模板中多余的分润金额是归属于收款方 receipt_reserved 还是服务方 service_reserved。
                'data' => [
                    [
                        'level' => 1,                       //子商户层级值，0 表示平台， 1 表示一级子商户，取值范围 >=0
                        'value' => 30                       //分润数值。rate 下取值为 0 - 10000，单位为 0.01 %，fixed 下取值为 0 - 1000000，单位为分
                    ],
                    ['level' => 2, 'value' => 20],
                    ['level' => 3, 'value' => 10],
                ],
            ],
            'description' => 'Your description',
        ]
    );
    echo $royalty_template;
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}

try {
    $royalty_tpl_info = \Pingpp\RoyaltyTemplate::update('451170807182300001', [
        'name' => 'royalty_template_name_new',             // 分润模板名称，允许中英文等常用字符
        'rule' => [
            'royalty_mode' => 'fixed',                   //分润模式。分为按订单金额（包含优惠券金额）的比例 rate 和固定金额 fixed
            'refund_mode' => 'full_refund',               //退分润模式。分为退款时不退分润 no_refund、按比例退分润 proportional 和一旦退款分润全退 full_refund
            'allocation_mode' => 'service_reserved',    //分配模式。指当订单确定的层级如果少于模板配置层级时，模板中多余的分润金额是归属于收款方 receipt_reserved 还是服务方 service_reserved。
            'data' => [
                [
                    'level' => 1,                       //子商户层级值，0 表示平台， 1 表示一级子商户，取值范围 >=0
                    'value' => 33                       //分润数值。rate 下取值为 0 - 10000，单位为 0.01 %，fixed 下取值为 0 - 1000000，单位为分
                ],
                ['level' => 2, 'value' => 22],
                ['level' => 3, 'value' => 11],
            ],
        ],
        'description' => 'Your description',
    ]);
    echo $royalty_tpl_info;
} catch (\Pingpp\Error\Base $e) {
// 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}

try {
    $royalty_tpl_info = \Pingpp\RoyaltyTemplate::retrieve('451170807182300001');
    echo $royalty_tpl_info;
} catch (\Pingpp\Error\Base $e) {
// 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}

try {
    $royalty_tpl_info = \Pingpp\RoyaltyTemplate::delete('451170807182300001');
    echo $royalty_tpl_info;
} catch (\Pingpp\Error\Base $e) {
// 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}


try {
    $params = [
        'page' => 1,
        'per_page' => 10,
    ];
    $royalty_tpl_info = \Pingpp\RoyaltyTemplate::all($params);
    echo $royalty_tpl_info;
} catch (\Pingpp\Error\Base $e) {
// 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}

