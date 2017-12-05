<?php
return [
    'account' => 'user@example.com',    //必填项 接收者支付宝账号。
    'name' => 3000,                     //必填项 接收者姓名。
    'type' => 'b2c',                    //选填项 转账类型。b2c：企业向个人付款，b2b：企业向企业付款。
    'account_type' => 'ALIPAY_USERID',  //选填项 收款方账户类型。ALIPAY_USERID：支付宝账号对应的支付宝唯一用户号，以 2088 开头的 16 位纯数字组成；ALIPAY_LOGONID：支付宝登录号，支持邮箱和手机号格式。
];