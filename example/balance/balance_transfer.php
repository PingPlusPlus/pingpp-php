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

// 创建余额转账
try{
    $balance_transfer = \Pingpp\BalanceTransfer::create(
        [
            'amount' => 10,             // 用户收到转账的余额，单位：分
            'user_fee' => 0,            // 向发起转账的用户额外收取的手续费，单位：分
            'user' => 'user_001',        // 发起转账的用户 ID（可以是 C类用户 或 B类用户，但不能填 0）
            'recipient' => '0',   // 接收转账的用户 ID（可以是 C类用户 或 B类用户，可以为 0）
            'order_no' => substr(md5(time()), 0, 10),           // 商户订单号，必须在商户系统内唯一
            'description' => 'Your description',        // 描述
            'metadata' => [],           // metadata 元数据
        ]
    );
    echo $balance_transfer;
}catch (\Pingpp\Error\Base $e){
    // 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}
exit;

//查询余额转账
try{
    $balance_transfer = \Pingpp\BalanceTransfer::retrieve('661170807435256330240000');
    echo $balance_transfer;
}catch (\Pingpp\Error\Base $e){
    // 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}
exit;

//查询余额转账列表
try {
    $params = [
        'page' => 1,
        'per_page' => 10,
    ];
    $balance_transfer = \Pingpp\BalanceTransfer::all($params);
    echo $balance_transfer;
} catch (\Pingpp\Error\Base $exception) {
// 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}