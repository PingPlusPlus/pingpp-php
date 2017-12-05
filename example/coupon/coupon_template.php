<?php
/* *
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
*/
require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

//创建 Coupon template 对象
try {
    $ct = \Pingpp\CouponTemplate::create(
        [
            'name'              => '25OFF',                // 优惠券模板名称
            'type'              => 2,                      // 优惠券模板的类型 1：现金券；2：折扣券
            'percent_off'       => 25,                     // 折扣百分比, 如 20 表示 8 折, 100 表示免费
            'amount_available'  => 10000,                  // 订单金额大于等于该值时，优惠券有效（适用于满减）；0 表示无限制
            'max_circulation'   => 1000,                   // 优惠券最大生成数量，当已生成数量达到最大值时，不能再生成优惠券；默认 null，表示可以无限生成
            'metadata'          => [],                     // metadata
            'expiration'        => null                    // 优惠券模板过期策略
        ]
    );
    echo $ct;                                              // 输出 Ping++ 返回的 Coupon template 对象
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//查询 Coupon template 对象
$coupon_tmpl_id = '300216111711073000022301';           // ping++返回的优惠券模板 ID
try {
    $ct = \Pingpp\CouponTemplate::retrieve($coupon_tmpl_id);
    echo $ct;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

//更新 Coupon template 对象
$coupon_tmpl_id = '300216111711073000022301';           // ping++返回的优惠券模板 ID
try {
    $ct = \Pingpp\CouponTemplate::update($coupon_tmpl_id, array(
        'metadata' => array(
            'keys' => 'value',
        )
    ));
    echo $ret;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//删除 Coupon template 对象
$coupon_tmpl_id = '300216111711073000022301';           // ping++返回的优惠券模板 ID
try {
    $ct = \Pingpp\CouponTemplate::delete($coupon_tmpl_id);
    echo $ct;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

//查询 Coupon template 对象列表
$search_params = [              //搜索条件，此数组可以为空
    'page'      => 1,           //页码，取值范围：1~1000000000；默认值为"1"
    'per_page'  => 2            //每页数量，取值范围：1～100；默认值为"20"
];
try {
    $ct_all = \Pingpp\CouponTemplate::all($search_params);
    echo $ct_all;                                                     // 输出 Ping++ 返回的 Coupon template 对象列表
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
