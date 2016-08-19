<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入企业付款流程参考开发者中心：https://www.pingxx.com/docs/server/transfer ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/

require dirname(__FILE__) . '/../init.php';

// api_key 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击管理平台右上角公司名称->开发信息-> Secret Key
$api_key = 'sk_test_ibbTe5jLGCi5rzfH4OqPW9KC';
// app_id 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击你创建的应用->应用首页->应用 ID(App ID)
$app_id = 'app_1Gqj58ynP0mHeX1q';

\Pingpp\Pingpp::setApiKey($api_key);

// 创建 Transfer
try {
    $tr = \Pingpp\Transfer::create(
        array(
            'amount'    => 100,// 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100,企业付款最小发送金额为 1 元）
            'order_no'  => date('mdHis') . mt_rand(1, 9999),// 企业转账使用的商户内部订单号。wx(新渠道)、wx_pub 规定为 1 ~ 50 位不能重复的数字字母组合、unionpay 为不 1~16 位数字
            'currency'  => 'cny',
            'channel'   => 'unionpay',// 目前支持 wx(新渠道)、 wx_pub、unionpay
            'app'       => array('id' => $app_id),
            'type'      => 'b2c',// 付款类型，当前仅支持 b2c 企业付款。
            'recipient' => 'o9zpMs9jIaLynQY9N6yxcZ',// 接收者 id， 为用户在 wx(新渠道)、wx_pub 下的 open_id
            'description' => 'testing',
            'extra' => array(
                'user_name' => 'User Name', //收款人姓名。当该参数为空，则不校验收款人姓名，选填
                'force_check' => false// 是否强制校验收款人姓名。仅当 user_name 参数不为空时该参数生效，选填
            )
        )
    );
    echo $tr;// 输出 Ping++ 返回的企业付款对象 Transfer
} catch (\Pingpp\Error\Base $e) {
    header('Status: ' . $e->getHttpStatus());
    echo($e->getHttpBody());
}

// 查询 Transfer
$tr = \Pingpp\Transfer::retrieve('TRANSFER_ID');

// 取消 Transfer
$tr['status'] = 'canceled';
$tr->save();
