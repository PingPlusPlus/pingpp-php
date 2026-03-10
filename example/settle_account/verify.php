<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(dirname(__DIR__)) . '/init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__DIR__) . '/config.php';

/** 结算账号打款验证接口（存管相关） */
$settle_account = \Pingpp\SettleAccount::verify(
    'user_001', // 用户 ID
    '320118012216303200004401', // 结算账户 ID
    [
        'receive_amount' => 2,
    ]
);

echo $settle_account;
