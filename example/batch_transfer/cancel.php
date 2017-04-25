<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入批量付款流程参考开发者中心：https://www.pingxx.com/api?language=PHP#batch-transfers-批量企业付款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';



// 取消付款 (仅unionpay渠道支持)
// unionpay 渠道在 batch transfer 对象请求成功后，延时5分钟发送转账，5分钟内订单处于scheduled的准备发送状态，且可调用该接口通过 batch transfer 对象的 id 更新一个已创建的 batch transfer 对象，即取消该笔转账
try {
    $batch_tr = \Pingpp\BatchTransfer::cancel('181611151506412852');        // 批量转账对象id ，由 Ping++ 生成（必须是unionpay渠道）
    echo $batch_tr;                                                         // 输出 Ping++ 返回的 batch transfer 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}