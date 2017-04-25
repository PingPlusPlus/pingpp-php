<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入批量付款流程参考开发者中心：https://www.pingxx.com/api?language=PHP#batch-transfers-批量企业付款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

// 渠道。支付宝：alipay，银联：unionpay，微信公众号：wx_pub，通联：allinpay，京东：jdpay
$channel = 'alipay';

// 接收者信息，不同渠道接收者信息字段会有差别
$recipients = require_once dirname(__FILE__) . '/channel_recipients/'. $channel .'.php';

//创建 Batch transfer 对象
try {
    $batch_tr = \Pingpp\BatchTransfer::create(
        [
            'amount'      => 8000,                  // 批量付款总金额，单位为分。为 recipients 中 amount 的总和。
            'app'         => APP_ID,
            'batch_no'    => uniqid('btr'),         // 批量转账批次号，3-24位，允许字母和英文
            'channel'     => $channel,              // 渠道。支付宝：alipay，银联：unionpay，微信公众号：wx_pub，通联：allinpay，京东：jdpay
            'description' => 'Your Description',    // 批量转账详情，最多 255 个 Unicode 字符
            'recipients'  => $recipients,
            'type'      => 'b2c'                    // 付款类型 (当前 alipay、wx_pub 仅支持: b2c, unionpay、allinpay、jdpay 支持:  b2b、b2c)
        ]
    );
    echo $batch_tr;                                 // 输出 Ping++ 返回的 batch transfer 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}