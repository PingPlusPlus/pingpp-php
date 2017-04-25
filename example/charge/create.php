<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入支付流程参考开发者中心：https://www.pingxx.com/docs/server ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';


// 此处为 Content-Type 是 application/json 时获取 POST 参数的示例
$input_data = json_decode(file_get_contents('php://input'), true);
if (empty($input_data['channel']) || empty($input_data['amount'])) {
    echo 'channel or amount is empty';
    exit();
}
$channel = strtolower($input_data['channel']);
$amount = $input_data['amount'];
$orderNo = substr(md5(time()), 0, 12);

/**
 * $extra 在使用某些渠道的时候，需要填入相应的参数，其它渠道则是 array()。
 * 以下 channel 仅为部分示例，未列出的 channel 请查看文档 https://pingxx.com/document/api#api-c-new；
 * 或直接查看开发者中心：https://www.pingxx.com/docs/server；包含了所有渠道的 extra 参数的示例；
 */
$channel_extra = dirname(__FILE__) . '/channel_extra/'. $channel .'.php';
$extra = file_exists($channel_extra) ? require_once $channel_extra : [];

try {
    $ch = \Pingpp\Charge::create(
        array(
            // 请求参数字段规则，请参考 API 文档：https://www.pingxx.com/api#api-c-new
            'subject'   => 'Your Subject',
            'body'      => 'Your Body',
            'amount'    => $amount,                 // 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100）
            'order_no'  => $orderNo,                // 推荐使用 8-20 位，要求数字或字母，不允许其他字符
            'currency'  => 'cny',
            'extra'     => $extra,
            'channel'   => $channel,                // 支付使用的第三方支付渠道取值，请参考：https://www.pingxx.com/api#api-c-new
            'client_ip' => $_SERVER['REMOTE_ADDR'], // 发起支付请求客户端的 IP 地址，格式为 IPV4，如: 127.0.0.1
            'app'       => array('id' => APP_ID)
        )
    );
    echo $ch;                                       // 输出 Ping++ 返回的支付凭据 Charge
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}