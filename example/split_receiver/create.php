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

//创建分账接收方
$params = [
    'app'       => APP_ID,
    'type'      => 'MERCHANT_ID',   //分账接收方类型
    'name'      => '示例商户全称',    //分账接收方全称
    'account'   => '190001001',     //分账接收方帐号
    'channel'   => 'wx_pub_qr',     //分账接收方使用的渠道
];
$split_receiver = \Pingpp\SplitReceiver::create($params);
echo $split_receiver;
