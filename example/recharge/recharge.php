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

//创建充值订单
try {
    $or = \Pingpp\Recharge::create([
        'user' => 'user_test_01',
        'charge' => [
            'amount' => 100,
            'channel' => 'alipay_qr',
            'order_no' => substr(md5(time()), 0, 10),
            'subject' => 'Your subject',
            'body' => 'Your recharge body',
            'time_expire' => time()+ 3600,
            'client_ip' => '127.0.0.1',
            'extra' => [],
        ],
//        'user_fee' => 0,
        'balance_bonus' => [
            'amount' => 10,
        ],
        'from_user' => 'user_test_01',
        'description' => 'Your description',
        'metadata' => [],
    ]);
    echo $or;
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}
exit;

//查询充值订单
try{
    $recharge_info = \Pingpp\Recharge::retrieve('221170807730968330240000');
    echo $recharge_info;
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

//查询充值订单列表
try{
    $params = [
        'page' => 1,
        'per_page' => 100,
    ];
    $recharge_list = \Pingpp\Recharge::all($params);
    echo $recharge_list;
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

//创建充值退款
try{
    $recharge_refund = \Pingpp\Recharge::refund('221170807730968330240000', [
        'description' => 'Rechage refund description',
        'metadata' => [],
    ]);
    echo $recharge_refund;
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

//查询充值退款
try {
    $recharge_refund_info = \Pingpp\Recharge::refundRetrieve('221170807730968330240000', 're_iTqLaTe1WTmHvXjrv9i5C8G4');
    echo $recharge_refund_info;
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}
exit;

//查询充值退款列表
try {
    $recharge_refund_info = \Pingpp\Recharge::refundList('221170807730968330240000');
    echo $recharge_refund_info;
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != NULL) {
        echo $e->getHttpStatus() . PHP_EOL;
        echo $e->getHttpBody() . PHP_EOL;
    } else {
        echo $e->getMessage() . PHP_EOL;
    }
}