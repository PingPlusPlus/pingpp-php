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

//创建余额赠送
try {
    $balance_bonus = \Pingpp\BalanceBonus::create([
        'amount' => 10,
        'description' => '余额赠送描述',
        'user' => 'user_test_01',
        'order_no' => substr(md5(time()), 0, 10),
    ]);
    echo $balance_bonus;
} catch (\Pingpp\Error\Base $exception) {
// 捕获报错信息
    if ($exception->getHttpStatus() != NULL) {
        echo $exception->getHttpStatus() . PHP_EOL;
        echo $exception->getHttpBody() . PHP_EOL;
    } else {
        echo $exception->getMessage() . PHP_EOL;
    }
}

//查询余额赠送
try {
    $balance_bonus = \Pingpp\BalanceBonus::retrieve('651170807590953932800000');
    echo $balance_bonus;
} catch (\Pingpp\Error\Base $exception) {
// 捕获报错信息
    if ($exception->getHttpStatus() != NULL) {
        echo $exception->getHttpStatus() . PHP_EOL;
        echo $exception->getHttpBody() . PHP_EOL;
    } else {
        echo $exception->getMessage() . PHP_EOL;
    }
}

//查询余额赠送列表
try {
    $params = [
        'page' => 1,
        'per_page' => 10,
        'user' => 'user_test_01', //受赠的用户 ID
    ];
    $balance_bonus = \Pingpp\BalanceBonus::all($params);
    echo $balance_bonus;
} catch (\Pingpp\Error\Base $exception) {
// 捕获报错信息
    if ($exception->getHttpStatus() != NULL) {
        echo $exception->getHttpStatus() . PHP_EOL;
        echo $exception->getHttpBody() . PHP_EOL;
    } else {
        echo $exception->getMessage() . PHP_EOL;
    }
}