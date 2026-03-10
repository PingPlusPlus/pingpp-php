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

//提现使用渠道。银联：unionpay，支付宝：alipay，微信：wx_pub，通联：allinpay，京东：jdpay。
$channel = 'unionpay';
// 附加参数，不同渠道接收者信息字段会有差别
$extra = require_once dirname(__FILE__) . '/extra/' . $channel . '.php';
// 创建余额提现申请
try {
    $params = [
        'user' => 'user_test_01',                       // 用户 ID
        'amount' => 200,                                        // 转账金额
        'channel' => $channel,                                  //提现使用渠道。银联：unionpay，支付宝：alipay，微信：wx_pub，通联：allinpay，京东：jdpay。
        'user_fee' => 10,                                       //用户需要承担的手续费
        'description' => 'Your Description',                        //描述。
        'order_no' => time() . mt_rand(100000, 999999), //提现订单号,unionpay 为1~16位的纯数字;alipay 为 1 ~ 64 位不能重复的数字字母组合;allinpay 为通联商户号(10位数字) + 不重复流水号组合(10~30位 字母数字组合);wx_pub 规定为 1 ~ 50 位不能重复的数字字母组合;jdpay为 1~64 位不能重复的数字字母组合;
        'extra' => $extra,  //附加参数。
        //'settle_account' => '320217022818035400000601', //使用结算账户提现，不需要填写 channel 和 extra 相关参数，同时填写时，结算账号不生效
    ];
    $withdrawal = \Pingpp\Withdrawal::create($params);
    echo $withdrawal;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
