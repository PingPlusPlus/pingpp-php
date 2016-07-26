<?php
require dirname(__FILE__) . '/../init.php';

// api_key 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击管理平台右上角公司名称->开发信息-> Secret Key
$api_key = 'sk_test_ibbTe5jLGCi5rzfH4OqPW9KC';
// app_id 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击你创建的应用->应用首页->应用 ID(App ID)
$app_id = 'app_1Gqj58ynP0mHeX1q';

// 设置 API Key
\Pingpp\Pingpp::setApiKey($api_key);

// 设置私钥
\Pingpp\Pingpp::setPrivateKeyPath(__DIR__ . '/your_rsa_private_key.pem');

// 调用身份证认证接口
try {
    $result = \Pingpp\Identification::identify(array(
        'type' => 'id_card',
        'app' => $app_id,
        'data' => array(
            'id_name' => '张三', // 姓名
            'id_number' => '310181198910107641' // 身份证号
        )
    ));
    echo $result;
} catch (\Pingpp\Error\Base $e) {
    echo $e->getMessage();
}

// 调用银行卡认证接口
try {
    $result = \Pingpp\Identification::identify(array(
        'type' => 'bank_card',
        'app' => $app_id,
        'data' => array(
            'id_name' => '张三', // 姓名
            'id_number' => '310181198910107641', // 身份证号,
            'card_number' => '6201111122223333', // 银行卡号
            'phone_number' => '18623234545' // 银行预留手机号，不支持 178 号段
        )
    ));
    echo $result;
} catch (\Pingpp\Error\Base $e) {
    echo $e->getMessage();
}
