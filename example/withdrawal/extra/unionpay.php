<?php
return [
    'account' => '6225210207078888',    //必填项 收款人银行卡号或者存折号。
    'name' => '张三',                    //必填项 收款人姓名。
    'open_bank_code' => '0308',          //选填项 开户银行编号，open_bank_code 和 open_bank 必须填写一个，优先推荐填写 open_bank_code。
    'open_bank' => '招商银行',            //选填项 开户银行，open_bank_code 和 open_bank 必须填写一个，优先推荐填写 open_bank_code。
    'prov' => '上海',                    //选填项 省份。
    'city' => '上海',                    //选填项 城市。
    'sub_bank' => '徐家汇支行',           //选填项 开户支行名称。
];