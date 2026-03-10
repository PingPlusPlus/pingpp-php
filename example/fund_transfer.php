<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require __DIR__ . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require __DIR__ . '/config.php';

//创建资金充值申请
try {
    $or = \Pingpp\FundsTransfer::create([
        'channel' => 'alipay_fund',
        'order_no' => '20250411000001',
        'amount' => 1000,
        'subject' => '测试充值',
        'description' => 'Your description',
    ]);
    echo $or;
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != null) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}
exit;

//查询资金充值申请订单
try {
    $recharge_info = \Pingpp\FundsTransfer::retrieve('7312504116419046403');
    echo $recharge_info;
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != null) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}
exit;