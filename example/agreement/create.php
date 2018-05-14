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
if (empty($input_data['channel'])) {
    echo 'channel is empty';
    exit();
}
$channel = strtolower($input_data['channel']);

$channel_extra = dirname(__FILE__) . '/channel_extra/'. $channel .'.php';
$extra = file_exists($channel_extra) ? require_once $channel_extra : [];

try {
    $agreement = \Pingpp\Agreement::create(
        [
            'app'           => APP_ID,                  // App ID
            'contract_no'   => 'Your Contract No',      // 签约协议号
            'channel'       => $channel,                // 签约渠道
            'extra'         => $extra,                  // 附加信息
            'metadata'      => [],                      // metadata 元数据
        ]
    );
    echo $agreement;                                       // 输出 Ping++ 返回的 agreement
} catch (\Pingpp\Error\Base $e) {
    // 捕获报错信息
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}