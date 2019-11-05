<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

/**
 * 创建分润 SDK示例
 */
$order_id = '2011905090000004271';
try {
    $royalty_data = \Pingpp\Royalty::createData($order_id,
        [
            'app' => APP_ID,                                   // 必填，订单应用，对应 app 对象的 id
            'charge' => 'ch_SuTCO4SmHmL050a9OKnj94uH',         // 可选，charge id，对于已经成功的 order 必传该字段，若 order 未成功不支持填写
            'royalty_users' => [                               // 可选，分润的用户信息列表
                [
                    'user' => 'U201908030002',
                    'amount' => 100
                ]
            ]
        ]
    );
    echo $royalty_data;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}