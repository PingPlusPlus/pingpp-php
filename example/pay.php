<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，只是提供一个参考。
*/

require_once(dirname(__FILE__) . '/../init.php');
$input_data = json_decode(file_get_contents('php://input'), true);
if (empty($input_data['channel']) || empty($input_data['amount'])) {
    exit();
}
$channel = strtolower($input_data['channel']);
$amount = $input_data['amount'];
$orderNo = substr(md5(time()), 0, 12);

//$extra 在渠道为 upmp_wap 和 alipay_wap 时，需要填入相应的参数，具体见技术指南。其他渠道时可以传空值也可以不传。
$extra = array();
switch ($channel) {
    case 'alipay_wap':
        $extra = array(
            'success_url' => 'http://www.yourdomain.com/success',
            'cancel_url' => 'http://www.yourdomain.com/cancel'
        );
        break;
    case 'upmp_wap':
        $extra = array(
            'result_url' => 'http://www.yourdomain.com/result?code='
        );
        break;
}

\Pingpp\Pingpp::setApiKey('YOUR-KEY');
try {
    $ch = \Pingpp\Charge::create(
        array(
            "subject"   => "Your Subject",
            "body"      => "Your Body",
            "amount"    => $amount,
            "order_no"  => $orderNo,
            "currency"  => "cny",
            "extra"     => $extra,
            "channel"   => $channel,
            "client_ip" => $_SERVER["REMOTE_ADDR"],
            "app"       => array("id" => "YOUR-APP-ID")
        )
    );
    echo $ch;
} catch (\Pingpp\Error\Base $e) {
    header('Status: ' . $e->getHttpStatus());
    echo($e->getHttpBody());
}
