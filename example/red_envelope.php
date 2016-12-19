<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入红包流程参考开发者中心：https://www.pingxx.com/docs/server/red-envelope ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/

require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require 'config.php';
// 设置 API Key
\Pingpp\Pingpp::setApiKey(APP_KEY);

try {
    $red = \Pingpp\RedEnvelope::create(
        array(
            'subject'     => 'Your Subject',
            'body'        => 'Your Body',
            'amount'      => 100,// 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100，金额限制在 100 ~ 20000 之间，即 1 ~ 200 元）
            'order_no'    => date('YmdHis') . (microtime(true) % 1) * 1000 . mt_rand(0, 9999),// 红包使用的商户订单号。wx(新渠道)、wx_pub 规定为 1 ~ 28 位不能重复的数字
            'currency'    => 'cny',
            'extra'       => array(
                'send_name' => 'Send Name'// 商户名称，最多 32 个字节
            ),
            'recipient'   => 'Openid',// 接收者 id， 为用户在 wx(新渠道)、wx_pub 下的 open_id
            'channel'     => 'wx_pub',// 目前支持 wx(新渠道)、 wx_pub
            'app'         => array('id' => APP_ID),
            'description' => 'Your Description'
        )
    );
    echo $red;// 输出 Ping++ 返回的红包对象 Red_envelope
} catch (\Pingpp\Error\Base $e) {
    header('Status: ' . $e->getHttpStatus());
    echo($e->getHttpBody());
}
