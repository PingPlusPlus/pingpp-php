<?php
return [
    // 必须，1~32位，收款人银行卡号或者存折号。
    'card_number' => '6228480402564890011',

    // 必须，1~100位，收款人姓名。
    'user_name' => '张三',

    /**
     * open_bank_code 和 open_bank 两个参数必传一个，建议使用 open_bank_code ，若都传参则优先使用 open_bank_code 读取规则；prov 和 city 均为可选参数，如果不传参，则使用默认值 "上海" 给渠道接口。
     */

    // 条件可选，4位，开户银行编号，详情请参考 企业付款（银行卡）银行编号说明：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E。
    'open_bank_code' => '0103',

    // 条件可选，1~50位，开户银行，详情请参考 企业付款（银行卡）银行编号说明：https://www.pingxx.com/api#%E9%93%B6%E8%A1%8C%E7%BC%96%E5%8F%B7%E8%AF%B4%E6%98%8E。
    'open_bank' => '农业银行',

    // 可选，1～20位，省份。
    // 'prov' => '上海',

    // 可选，1～40位，城市。
    // 'city' => '上海',

    // 可选，1～80位，开户支行名称。
    // 'sub_bank'    => '上海沪东支行'
];