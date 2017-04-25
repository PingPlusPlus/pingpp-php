<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * API 文档：https://www.pingxx.com/api#batch-refunds-批量退款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';


//创建 Batch refund 对象
try {
    $batch_re = \Pingpp\BatchRefund::create(
        [
            'app'         => APP_ID,
            'batch_no'    => uniqid('bre'),         //批量退款批次号，3-24位，允许字母和英文
            'description' => 'Your Description',    //批量退款详情，最多 255 个 Unicode 字符
            'charges'     => [                      //需要退款的  charge id 列表，一次最多 100 个
                'ch_Dq5ibDrLurrPO808q1bP4iT8',
                'ch_TanbTO9OmjP4TGW5a1j1mPiL'
            ]
        ]
    );
    echo $batch_re;                                 // 输出 Ping++ 返回的 batch refund 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}