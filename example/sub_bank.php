<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/config.php';

// 调用银行支行列表查询接口
try {
    $sub_banks = \Pingpp\SubBank::query([
        'app' => APP_ID, // Ping++ app id，必填
        'channel' => 'chanpay', // transfer 渠道，必填
        'open_bank_code' => '0308', // 银行编号，必填
        'prov' => '浙江省', // 省份，必填
        'city' => '宁波市', // 城市，必填
    ]);
    echo $sub_banks;
} catch (\Pingpp\Error\Base $e) {
    echo $e->getMessage();
}
