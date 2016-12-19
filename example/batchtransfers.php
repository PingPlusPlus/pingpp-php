<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入批量付款流程参考开发者中心：https://www.pingxx.com/api?language=PHP#batch-transfers-批量企业付款 ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require 'config.php';
\Pingpp\Pingpp::setApiKey(APP_KEY);                                         // 设置 API Key
\Pingpp\Pingpp::setAppId(APP_ID);                                           // 设置 APP ID
\Pingpp\Pingpp::setPrivateKeyPath(__DIR__ . '/your_rsa_private_key.pem');   // 设置私钥

//创建 Batch transfer 对象
try {
    $batch_tr = \Pingpp\BatchTransfer::create(
        [
            'amount'      => 8000,
            'app'         => APP_ID,
            'batch_no'    => uniqid('btr'),         //批量退款批次号，3-24位，允许字母和英文
            'channel'     => 'alipay',              //
            'description' => 'Your Description',    //批量退款详情，最多 255 个 Unicode 字符
            'recipients'  => [                      //需要退款的  charge id 列表，一次最多 100 个
                [
                    'account' => 'account01@alipay.com',
                    'amount'  => 5000,
                    'name'    => '张三'
                ],
                [
                    'account' => 'account02@alipay.com',
                    'amount'  => 3000,
                    'name'    => '李四'
                ]
            ],
            'type'      => 'b2c'
        ]
    );
    echo $batch_tr;                                 // 输出 Ping++ 返回的 batch transfer 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//查询 Batch transfer 对象
try {
    $batch_tr = \Pingpp\BatchTransfer::retrieve('181611151506412852');        //批量转账对象id ，由 Ping++ 生成
    echo $batch_tr;                                                         // 输出 Ping++ 返回的 batch transfer 对象列表
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//查询 Batch transfer 对象列表
//更多查询参数可以参照此链接 https://www.pingxx.com/api?language=cURL#查询-batch-transfer-对象列表
$search_params = [              //搜索条件，此数组可以为空
    'page'      => 1,           //页码，取值范围：1~1000000000；默认值为"1"
    'per_page'  => 2            //每页数量，取值范围：1～100；默认值为"20"
];
try {
    $batch_tr_all = \Pingpp\BatchTransfer::all($search_params);
    echo $batch_tr_all;                                                     // 输出 Ping++ 返回的 batch transfer 对象列表
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}