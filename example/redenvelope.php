<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入红包流程参考开发者中心：https://www.pingxx.com/docs/server/red-envelope ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/

require dirname(__FILE__) . '/../init.php';

// api_key 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击管理平台右上角公司名称->开发信息-> Secret Key
$api_key = 'sk_test_ibbTe5jLGCi5rzfH4OqPW9KC';
// app_id 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击你创建的应用->应用首页->应用 ID(App ID)
$app_id = 'app_1Gqj58ynP0mHeX1q';

\Pingpp\Pingpp::setApiKey($api_key);
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
            'app'         => array('id' => $app_id),
            'description' => 'Your Description'
        )
    );
    echo $red;// 输出 Ping++ 返回的红包对象 Red_envelope
} catch (\Pingpp\Error\Base $e) {
    header('Status: ' . $e->getHttpStatus());
    echo($e->getHttpBody());
}
