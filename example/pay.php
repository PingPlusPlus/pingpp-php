<?php
/* *
 * Ping++ Server SDK
 * 版本日期：2014-10-10
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，只是提供一个参考。
*/
require_once(dirname(__FILE__) . '/../lib/PingPP.php');
$input_data = json_decode(file_get_contents("php://input"), true);
if (empty($input_data['channel']) || empty($input_data['amount'])) {
    exit();
}
$channel = strtolower($input_data['channel']);
$amount = $input_data['amount'];
$orderNo = substr(md5(time()), 0, 12);

$extra = isset($input_data['extra']) ? $input_data['extra'] : null;
if (!isset($extra)) {
    if ($channel == 'alipay_wap') {
        $extra = array('success_url' => 'www.success.com', 'cancel_url' => 'www.cancel.com');
    } else if ($channel == 'upmp_wap') {
        $extra = array('result_url' => 'www.result.com');
    }
}
PingPP::setApiKey("sk_live_bDivDS50CeTOC4Sy94DaLGGK");
$ch = PingPP_Charge::create(
    array(
        "subject" => "一心一益",
        "body" => "一个爱心一份公益",
        "amount" => $amount,
        "order_no" => $orderNo,
        "currency" => "cny",
        "extra" => $extra,
        "channel" => $channel,
        "client_ip" => $_SERVER["REMOTE_ADDR"],
        "app" => array("id" => "app_bTyrT0DmfTmDGmT0")
    )
);
echo $ch;
