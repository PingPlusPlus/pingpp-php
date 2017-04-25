<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * API 文档：https://www.pingxx.com/api#transfers-企业付款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

// 渠道。支付宝：alipay，银联：unionpay，微信公众号：wx_pub，通联：allinpay，京东：jdpay
$channel = 'wx_pub';

// 不同渠道 extra 有差别
$extra = require_once dirname(__FILE__) . '/channel/'. $channel .'.php';

// 创建 Transfer
try {
    $tr = \Pingpp\Transfer::create(
        [
            // 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100,企业付款最小发送金额为1 元）
            'amount'      => 100,

            // 付款使用的商户内部订单号。 wx_pub 规定为 1 ~ 50 位不能重复的数字字母组合;  alipay 为 1 ~ 64 位不能重复的数字字母组合; unionpay 为1~16位的纯数字。jdpay 限长1-64位不能重复的数字字母组合；allinpay 限长20-40位不能重复的数字字母组合，必须以签约的通联的商户号开头（建议组合格式：通联商户号 + 时间戳 + 固定位数顺序流水号，不包含+号）
            'order_no'    => date('mdHis') . mt_rand(1, 9999),

            // 三位 ISO 货币代码，目前仅支持人民币: cny 。
            'currency'    => 'cny',

            // 目前支持 支付宝：alipay，银联：unionpay，微信公众号：wx_pub，通联：allinpay，京东：jdpay
            'channel'     => $channel,

            // 转账使用的 app 对象的 id
            'app'         => ['id' => APP_ID],

            // 付款类型，支持 b2c 、b2b
            'type'        => 'b2c',

            // 接收者 id， 微信企业付款时为用户在 wx_pub 下的 open_id ;渠道为 alipay 时，若 type 为 b2c，为个人支付宝账号，若 type 为 b2b，为企业支付宝账号。渠道为 unionpay、allinpay、jdpay 时，不需要传该参数。
            'recipient'   => 'o9zpMs9jIaLynQY9N6yxcZ',

            // 备注信息。
            // 渠道为 unionpay 时，最多 99 个 Unicode 字符；
            // 渠道为 wx_pub 时，最多 99 个英文和数字的组合或最多 33 个中文字符，不可以包含特殊字符；
            // 渠道为 alipay 时，最多 100 个 Unicode 字符。
            // 渠道为 jdpay 最多100个 Unicode 字符。
            // 渠道为 allinpay 最多30个 Unicode 字符
            'description' => 'testing',

            // 相关的附加参数
            'extra'       => $extra
        ]
    );
    // 输出 Ping++ 返回的企业付款对象 Transfer
    echo $tr;
} catch (\Pingpp\Error\Base $e) {
    header('Status: ' . $e->getHttpStatus());
    echo($e->getHttpBody());
}