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


//查询 Batch refund 对象列表
//更多查询参数可以参照此链接 https://www.pingxx.com/api?language=cURL#查询-batch-refund-对象列表
$search_params = [              //搜索条件，此数组可以为空
    'page'      => 1,           //页码，取值范围：1~1000000000；默认值为"1"
    'per_page'  => 2            //每页数量，取值范围：1～100；默认值为"20"
];
try {
    $batch_re_all = \Pingpp\BatchRefund::all($search_params);
    echo $batch_re_all;                                                     // 输出 Ping++ 返回的 batch refund 对象列表
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}