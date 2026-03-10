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


// 撤销订单
// 此接口仅接受线下 isv_scan、isv_wap、isv_qr 渠道的订单调用。
// 本接口有两重作用，对于未成功付款的订单进行撤销，则关闭交易，使用户后期不能支付成功；
// 对于成功付款的订单进行撤销，系统将订单金额返还给用户，相当于对此交易做退款。

$charge_id = 'ch_bTyjfTnzHCaHOyjbzP4mHmX1';
try {
    $charge = \Pingpp\Charge::reverse($charge_id);
    echo $charge;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
