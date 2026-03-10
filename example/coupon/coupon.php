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

//创建 Coupon 对象
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$params = [
    'coupon_template' => '300216111619300600019101',                        // 优惠券模版 ID
];
try {
    $cp = \Pingpp\Coupon::create($user_id, $params);
    echo $cp;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//查询 Coupon 对象
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$coupon_id = '300416111711463500023901';                                    // 优惠券 ID
try {
    $cp = \Pingpp\Coupon::retrieve($user_id, $coupon_id);
    echo $cp;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

//更新 Coupon 对象
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$coupon_id = '300416111711571500024101';                                    // 优惠券 ID
$params = [
    'metadata' => [
        'key' => 'value'
    ]
];
try {
    $cp = \Pingpp\Coupon::update($user_id, $coupon_id, $params);
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//删除 Coupon 对象
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$coupon_id = '300416111711463500023901';                                    // 优惠券 ID
try {
    $cp = \Pingpp\Coupon::delete($user_id, $coupon_id);
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

//查询 Coupon 对象列表
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$search_params = [                                                          //搜索条件，此数组可以为空
    'page'      => 1,                                                       //页码，取值范围：1~1000000000；默认值为"1"
    'per_page'  => 2                                                        //每页数量，取值范围：1～100；默认值为"20"
];
try {
    $cp_all = \Pingpp\Coupon::all($user_id, $search_params);
    echo $cp_all;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;

//批量创建优惠券
$coupon_tmpl_id = '300216111711085500022401';                               // ping++返回的优惠券模板 ID
$params = [
    'users' => [
        'uid582d1756b1650',
        'user007@gmail.com',
    ]
];
try {
    $cp = \Pingpp\CouponTemplate::batchCreateCoupons($coupon_tmpl_id, $params);
    echo $cp;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;


//查询优惠券模板下的优惠券列表
$coupon_tmpl_id = '300216111711085500022401';                               // ping++返回的优惠券模板 ID
try {
    $cp = \Pingpp\CouponTemplate::couponsList($coupon_tmpl_id);
    echo $cp;
} catch (\Pingpp\Error\Base $e) {
    if ($e->getHttpStatus() != null) {
        header('Status: ' . $e->getHttpStatus());
        echo $e->getHttpBody();
    } else {
        echo $e->getMessage();
    }
}
exit;
