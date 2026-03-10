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

//创建分账
$params = [
    'app' => APP_ID,
    'charge' => 'ch_aDC44OKyL8yHPG0yX9yzLy5K', //Ping++ 交易成功的 charge ID
    'order_no' => md5(openssl_random_pseudo_bytes(30)),   //分账单号，由商家自行生成，规则参照微信分账参数规则
    'recipients' => [
        [
            'split_receiver' => 'recv_1fRbIo5YgIM4hl',
            'amount' => 6,
            'name' => '示例商户全称', //可选参数,
            'description' => 'Your Description',
        ]
    ],
    'type' => 'split_normal',   //分账类型: split_normal 为普通分账,split_return 为完结分账,
    'metadata' => [],   //分账元数据
];
$split_profit = \Pingpp\SplitProfit::create($params);
echo $split_profit;
