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

//批量提现示例

// 批量提现取消
$params = [
    'withdrawals' => [
        '1701611150302360654',
        '1701611151015078981'
    ]
];
try {
    $batch_withdrawal = \Pingpp\BatchWithdrawal::cancel($params);
    echo $batch_withdrawal;                                 // 输出 Ping++ 返回的 withdrawal 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

// 批量提现确认
$params = [
    'withdrawals' => [
        '1701611150302360654',
        '1701611151015078981'
    ]
];
try {
    $batch_withdrawal = \Pingpp\BatchWithdrawal::confirm($params);
    echo $batch_withdrawal;                                 // 输出 Ping++ 返回的 withdrawal 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

// 批量提现查询
$batch_withdrawal_id = '1901611151015122025';
try {
    $batch_withdrawal = \Pingpp\BatchWithdrawal::retrieve($batch_withdrawal_id);
    echo $batch_withdrawal;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

// 批量提现列表查询
$params = ['per_page' => 3];
try {
    $batch_withdrawal = \Pingpp\BatchWithdrawal::all($params);
    echo $batch_withdrawal;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;