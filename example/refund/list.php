<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * API 文档：https://www.pingxx.com/api#refunds-退款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';



try {
    // 查询 refund 对象列表
    $re_list = \Pingpp\Refund::all('ch_L8qn10mLmr1GS8e5OODmHaL4', [
        'limit' => 10,
    ]);
    echo $re_list;                                                   // 输出 Ping++ 返回的 refund 对象列表
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}