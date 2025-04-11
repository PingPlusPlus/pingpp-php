<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * API 文档：https://www.pingxx.com/api#transfers-企业付款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require __DIR__ . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require __DIR__ . '/../config.php';


//查询 transfer 对象
try {
    $tr = \Pingpp\Transfer::reverse('tr_130250408562336460800013');
    echo $tr; // 输出 Ping++ 返回的 transfer 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
