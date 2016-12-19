<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */
require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require 'config.php';
\Pingpp\Pingpp::setApiKey(APP_KEY);                                         // 设置 API Key
\Pingpp\Pingpp::setAppId(APP_ID);                                           // 设置 APP ID
\Pingpp\Pingpp::setPrivateKeyPath(__DIR__ . '/your_rsa_private_key.pem');   // 设置私钥

//创建 customs 对象
try {
    $cus = \Pingpp\Customs::create(
        [
            'app'               => APP_ID,
            'charge'            => 'ch_L8qn10mLmr1GS8e5OODmHaL4',
            'channel'           => 'alipay',
            'trade_no'          => '12332132131',         // 商户报关订单号,8~20位
            'customs_code'      => 'GUANGZHOU',
            'amount'            => 8000,
            'transport_amount'  => 10,
            'is_split'          => true,
            'sub_order_no'      => '123456',
            'extra'  => [
                'pay_account'   => '1234567890',
                'certif_type'   => '02',
                'customer_name' => 'A Name',
                'certif_id'     => 'ID Card No',
                'tax_amount'    => '10',
            ]
        ]
    );
    echo $cus;                                 // 输出 Ping++ 返回的 custom 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//查询 customs 对象
try {
    $cus = \Pingpp\Customs::retrieve('14201609281040220109');           // 报关对象id ，由 Ping++ 生成
    echo $cus;                                                         // 输出 Ping++ 返回的 custom 对象信息
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;
