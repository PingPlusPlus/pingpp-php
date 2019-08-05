<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(dirname(__DIR__)) . '/init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__DIR__) . '/config.php';

/** 更新结算账户(使用存管产品的商户) */
$settle_account = \Pingpp\SettleAccount::update(
    'user_001', // 用户 ID
    '320118012216303200004401', // 结算账户 ID
    [
        'recipient' => [
            'account' => '6214888888888866', // 银行卡号。
            'name' => '张三', // 接收者姓名。
            'type' => 'b2c', // 转账类型。b2c：企业向个人付款，b2b：企业向企业付款。
            'open_bank_code' => '0308', // 开户银行编号
            "open_bank" => "工商银行",
            "sub_bank" => "招商银行股份有限公司上海陆家嘴支行",
            "sub_bank_code" => "308290003773",
            'card_type' => 0, // 银行卡号类型，0：银行卡；1：存折。
            'mobile' => '13822334557', // 手机号
            "city" => "上海市",
            "prov" => "上海市",
        ],
    ]
);

echo $settle_account;

/** 结算账户更新手机号（存管相关） */
$settle_account = \Pingpp\SettleAccount::updateMobile(
    'user_001', // 用户 ID
    '320118012216303200004401', // 结算账户 ID
    [
        'mobile' => '13822334557',
    ]
);

echo $settle_account;
