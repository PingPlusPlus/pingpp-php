<?php
return [
    'account' => 'user@example.com',    //必填 收款人的支付宝账号。
    'name' => '张三',                    //必填 收款人姓名。
    'account_type' => 'ALIPAY_LOGONID', //选填参数 收款方账户类型。ALIPAY_USERID：支付宝账号对应的支付宝唯一用户号，以 2088 开头的 16 位纯数字组成；ALIPAY_LOGONID：支付宝登录号，支持邮箱和手机号格式。
];