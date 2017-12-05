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

// 结算账户渠道。alipay, wx_pub/wx, bank_account
$channel = 'alipay';

//创建结算账户
$recipient = require dirname(__FILE__) . '/recipient/' . $channel . '.php';
$settle_account = \Pingpp\SettleAccount::create('user_001', [
    'channel' => $channel,
    'recipient' => $recipient
]);
echo $settle_account;