<?php
/* *
 * Ping++ Server SDK
 * 版本日期：2014-10-10
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，只是提供一个参考。
*/
require_once(dirname(__FILE__) . '/../lib/PingPP.php');

$input_data = json_decode(file_get_contents('php://input'), true);

if(empty($input_data['channel']) || empty($input_data['amount'])) {
    exit();
}

$channel = strtolower($input_data['channel']);
$amount = $input_data['amount'];

$orderNo = substr(md5(time()), 0, 12);

PingPP::setApiKey('YOUR-KEY');
$ch = PingPP_Charge::create(
    array(
        'subject'  => 'Your Subject',
        'body'     => 'Your Body',
        'amount'   => $amount,
        'order_no' => $orderNo,
        'channel'  => $channel,
        'client_ip'=> '127.0.0.1',
        'currency'  => 'cny',
        'app' => array('id' => 'YOUR-APP-ID')
    )
);

echo $ch;
