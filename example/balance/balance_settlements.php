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

// 查询 Balance Settlement 对象
try {
    $balance_settlements = \Pingpp\BalanceSettlements::retrieve('670180130750711562240000');
    echo $balance_settlements;
} catch (\Pingpp\Error\Base $exception) {
// 捕获报错信息
    if ($exception->getHttpStatus() != NULL) {
        echo $exception->getHttpStatus() . PHP_EOL;
        echo $exception->getHttpBody() . PHP_EOL;
    } else {
        echo $exception->getMessage() . PHP_EOL;
    }
}
exit;

// 查询 Balance Settlement 对象列表
try {
    $params = [
        'user' => 'user_test_01', // 余额结算 user 对象的 id
        'page' => 1,
        'per_page' => 10,
    ];
    $balance_settlements = \Pingpp\BalanceSettlements::all($params);
    echo $balance_settlements;
} catch (\Pingpp\Error\Base $exception) {
// 捕获报错信息
    if ($exception->getHttpStatus() != NULL) {
        echo $exception->getHttpStatus() . PHP_EOL;
        echo $exception->getHttpBody() . PHP_EOL;
    } else {
        echo $exception->getMessage() . PHP_EOL;
    }
}