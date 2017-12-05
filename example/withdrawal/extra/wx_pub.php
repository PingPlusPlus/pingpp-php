<?php
return [
    'open_id' => 'wxopenid',    //必填参数 收款人的 open_id。
    'name' => '张三',            //必填参数 收款人姓名。
    'force_check' => false      //选填参数 是否强制校验收款人姓名。仅当 user_name 参数不为空时该参数生效。
];