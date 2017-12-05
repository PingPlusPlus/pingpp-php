<?php
return [
    'account' => 'wxopenid',    //必填参数 接收者 open_id。
    'name' => '张三',            //必填参数 收款人姓名。当该参数为空，则不校验收款人姓名。
    'force_check' => false,      //选填参数 是否强制校验收款人姓名。仅当 name 参数不为空时该参数生效。
    'type' => 'b2c',            // 选填参数 转账类型。b2c：企业向个人付款。
];