<?php
return [
    // 必填，客户端软件中展示的条码值，扫码设备扫描获取。
    'scan_code' => '286801346868493272',

    // 必填，终端号，要求不同终端此号码不一样，会显示在对账单中，如A01、SH008等。
    'terminal_id' => 'SH008',

    // 可选，商品列表，上送格式参照下面示例。
    // 字段解释：goods_id:商户定义商品编号（一般商品条码），goods_name:商品名称，quantity:数量，
    // price:单价(单位分)，goods_category:商品类目(可选)，body:商品描述信息(可选)，show_url:商品的展示网址(可选)
    'goods_list' => [
        [
            'goods_id' => 'iphone',
            'goods_name' => 'iPhone',
            'quantity' => 1,
            'price' => '528800',
            'goods_category' => '123456',
            'body' => '苹果手机',
            'show_url' => 'https://www.example.com',
        ],
        [
            'goods_id' => 'ipad',
            'goods_name' => 'ipad',
            'quantity' => 1,
            'price' => '528800',
            'goods_category' => '123456',
            'body' => '苹果 ipad',
            'show_url' => 'https://www.example.com',
        ],
    ],

    // 可选，商户操作员编号(可包含字母、数字、下划线、中划线)
    'operator_id' => 'yx_001',

    // 可选，商户门店编号(可包含字母、数字、下划线、中划线)
    'store_id' => 'SH_001',

    // 可选，系统商编号
    'sys_service_provider_id' => '2088511833207846',
];