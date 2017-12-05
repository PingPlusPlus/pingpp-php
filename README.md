# Pingpp PHP SDK

## 简介
lib 文件夹下是 PHP SDK 文件，  
example 文件夹里面是简单的接入示例，该示例仅供参考。

## 版本要求
PHP 版本 5.3 及以上  
你可以执行目录下的环境检测脚本，来进行一些基本检测
```bash
php PingppEnvInspect.php
```

## 安装
### 使用 Composer
执行
```
composer require pingplusplus/pingpp-php
```

使用 Composer 的 autoload 引入
```php
require_once('vendor/autoload.php');
```

### 手动引入
```php
require_once('/path/to/pingpp-php/init.php');
```

## 接入方法
### 初始化
```php
\Pingpp\Pingpp::setApiKey('YOUR-KEY');
```

### 设置请求签名密钥
密钥需要你自己生成，公钥请填写到 [Ping++ Dashboard](https://dashboard.pingxx.com)
```php
\Pingpp\Pingpp::setPrivateKeyPath('/path/to/your_rsa_private_key.pem');
```

### 支付
```php
$ch = \Pingpp\Charge::create(
    array(
        'order_no'  => '123456789',
        'app'       => array('id' => 'APP_ID'),
        'channel'   => 'alipay',
        'amount'    => 100,
        'client_ip' => '127.0.0.1',
        'currency'  => 'cny',
        'subject'   => 'Your Subject',
        'body'      => 'Your Body',
        'extra'     => $extra
    )
);
```

> 由于 PHP 5.3 不支持 `JsonSerializable` JSON 序列化接口，当你需要将其放入其他数组或者对象时，
> 建议先将其转成数组，例：`$arr = array('charge' => json_decode($ch, true))`。

### charge 查询
```php
\Pingpp\Charge::retrieve('CHARGE_ID');
```

```php
\Pingpp\Charge::all(array('limit' => 5, 'app' => array('id' => 'APP_ID')));
```

### 退款
```php
$re = \Pingpp\Refund::create('ch_a9CmfHTGGaz1urHiL8m5OiX1',
    array(
        'amount' => 1,
        'description' => 'Your Descripton'
    )
);
```

### 退款查询
```php
\Pingpp\Refund::retrieve('CHARGE_ID', 'REFUND_ID');
```

### 退款列表查询
```php
\Pingpp\Refund::all('CHARGE_ID',[
    'limit' => 5,
]);
```

### 微信红包
```php
\Pingpp\RedEnvelope::create(
    array(
        'order_no'  => '123456789',
        'app'       => array('id' => 'APP_ID'),
        'channel'   => 'wx_pub',
        'amount'    => 100,
        'currency'  => 'cny',
        'subject'   => 'Your Subject',
        'body'      => 'Your Body',
        'extra'     => array(
            'nick_name' => 'Nick Name',
            'send_name' => 'Send Name'
        ),
        'recipient'   => 'Openid',
        'description' => 'Your Description'
    )
);
```

### 查询指定微信红包
```php
\Pingpp\RedEnvelope::retrieve('RED_ID');
```

### 查询微信红包列表
```php
\Pingpp\RedEnvelope::all(array('limit' => 5));
```

### 微信公众号获取签名
如果使用微信 JS-SDK 来调起支付，需要在创建 `charge` 后，获取签名（`signature`），传给 HTML5 SDK。
```php
$jsapi_ticket_arr = \Pingpp\WxpubOAuth::getJsapiTicket($wx_app_id, $wx_app_secret);
$ticket = $jsapi_ticket_arr['ticket'];
```
**正常情况下，`jsapi_ticket` 的有效期为 7200 秒。由于获取 `jsapi_ticket` 的 api 调用次数非常有限，频繁刷新 `jsapi_ticket` 会导致 api 调用受限，影响自身业务，开发者必须在自己的服务器全局缓存 `jsapi_ticket`。**

_下面方法中 `$url` 是当前网页的 URL，不包含 `#` 及其后面部分_
```php
$signature = \Pingpp\WxpubOauth::getSignature($charge, $ticket, $url);
```
然后在 HTML5 SDK 里调用
```javascript
pingpp.createPayment(charge, callback, signature, false);
```

### event 查询

```php
\Pingpp\Event::retrieve('EVT_ID');
```

### event 列表查询
```php
\Pingpp\Event::all(array('type' => 'charge.succeeded'));
```
**详细信息请参考 [API 文档](https://pingxx.com/document/api?php)。**

### 微信企业付款
```php
\Pingpp\Transfer::create(
    array(
        'amount' => 100,
        'order_no' => '123456d7890',
        'currency' => 'cny',
        'channel' => 'wx_pub',
        'app' => array('id' => 'APP_ID'),
        'type' => 'b2c',
        'recipient' => 'o9zpMs9jIaLynQY9N6yxcZ',
        'description' => 'testing',
        'extra' => array('user_name' => 'User Name', 'force_check' => true)
    )
);
```

### 查询指定 transfer
```php
\Pingpp\Transfer::retrieve('TR_ID');
```

### 查询 transfer 列表
```php
\Pingpp\Transfer::all(array('limit' => 5));
```

### 身份证认证
```php
\Pingpp\Identification::identify(array(
    'type' => 'id_card',
    'app' => $app_id,
    'data' => array(
        'id_name' => '张三', // 姓名
        'id_number' => '310181198910107641' // 身份证号
    )
));
```

### 银行卡认证
```php
\Pingpp\Identification::identify(array(
    'type' => 'bank_card',
    'app' => $app_id,
    'data' => array(
        'id_name' => '张三', // 姓名
        'id_number' => '310181198910107641', // 身份证号,
        'card_number' => '6201111122223333', // 银行卡号
        'phone_number' => '18623234545' // 银行预留手机号，不支持 178 号段
    )
));
```

### 批量转账
```php
\Pingpp\BatchTransfer::create(
    [
        'amount'      => 8000,
        'app'         => APP_ID,
        'batch_no'    => uniqid('batch'),       // 批量退款批次号，3-24位，允许字母和英文
        'channel'     => 'alipay',
        'description' => 'Your Description',    // 批量退款详情，最多 255 个 Unicode 字符
        'recipients'  => [                      // 需要退款的  charge id 列表，一次最多 100 个
            [
                'account' => 'account01@alipay.com',
                'amount'  => 5000,
                'name'    => '张三'
            ],
            [
                'account' => 'account02@alipay.com',
                'amount'  => 3000,
                'name'    => '李四'
            ]
        ],
        'type'      => 'b2c'
    ]
);
```

### 查询指定批量转账
```php
\Pingpp\BatchTransfer::retrieve('181611151506412852'); // 批量转账对象id ，由 Ping++ 生成
```

### 查询批量转账列表
```php
\Pingpp\BatchTransfer::all(['page' => 1]);
```

### 批量退款
```php
\Pingpp\BatchRefund::create(
    [
        'app'         => APP_ID,
        'batch_no'    => uniqid('batch'),    // 批量退款批次号，3-24位，允许字母和英文
        'description' => 'Your Description', // 批量退款详情，最多 255 个 Unicode 字符
        'charges'     => [                   // 需要退款的  charge id 列表，一次最多 100 个
            'ch_qn5G8GH1SOCCvnv10S8mXTqP',
            'ch_SijjXL8Ki1u1arL1S49q5ifL'
        ]
    ]
);
```

### 查询指定批量退款
```php
\Pingpp\BatchRefund::retrieve('151611141520583238'); // 批量退款对象id ，由 Ping++ 生成
```

### 查询批量退款列表
```php
\Pingpp\BatchRefund::all(['page' => 1]);
```

### 报关
```php
\Pingpp\Customs::create(
    [
        'app'               => APP_ID,
        'charge'            => 'ch_L8qn10mLmr1GS8e5OODmHaL4',
        'channel'           => 'alipay',
        'trade_no'          => '12332132131',         // 商户报关订单号，8~20位
        'customs_code'      => 'GUANGZHOU',
        'amount'            => 8000,
        'transport_amount'  => 10,
        'is_split'          => true,
        'sub_order_no'      => '123456',
        'extra'  => [
            'pay_account'   => '1234567890',
            'certif_type'   => '02',
            'customer_name' => 'A Name',
            'certif_id'     => 'ID Card No',
            'tax_amount'    => '10',
        ]
    ]
);
```

### 查询指定报关
```php
\Pingpp\Customs::retrieve('14201609281040220109'); // 报关对象 ID，由 Ping++ 生成
```

## 创建商品订单
```php
\Pingpp\Order::create(
        array(
            "amount" => 100,
            "app" => APP_ID,
            "merchant_order_no" => "88888888888", //商户订单号
            "subject" => "subj{$order_no}",
            "currency" => "cny",
            "body" => "body{$order_no}",
            "uid" => "test_user_001",
            "client_ip" => "192.168.0.101"
        )
    );
```

## 商品订单支付
```php
\Pingpp\Order::pay('2011611170000003651', array(
    'balance_amount'    => 0,
    'charge_amount'     => 10,
    'channel' => 'alipay',
    'extra' => array(
        'key' => 'value'
    ),
));
```

## 商品订单取消
```php
\Pingpp\Order::cancel('2011611170000003651');   //订单对象 ID，由 Ping++ 生成
```

## 商品订单查询接口
```php
\Pingpp\Order::retrieve('2011611170000003651'); //订单对象 ID，由 Ping++ 生成
```

## 商品订单列表
```php
$params['app'] = APP_ID;
\Pingpp\Order::all($params);
```

## 商品订单退款
```php
\Pingpp\OrderRefund::create('2011708070000007521',
    [
        'description' => 'Your description',       //退款附加说明。
        'metadata' => [],
        'refund_mode' => 'to_source',              //退款模式。原路退回：to_source，退至余额：to_balance。默认为原路返回。
    ]
);
```

## 商品订单退款查询
```php
\Pingpp\OrderRefund::retrieve('2011611160000343961', 're_OW1CSS8KCS0KvfzDu5jTerrH');
```

##  商品订单退款列表查询
```php
\Pingpp\OrderRefund::all('2011611160000343961');
```

## 用户充值
```php
\Pingpp\Recharge::create([
    'user' => 'user_test_01',
    'charge' => [
        'amount' => 100,
        'channel' => 'alipay_qr',
        'order_no' => substr(md5(time()), 0, 10),
        'subject' => 'Your subject',
        'body' => 'Your recharge body',
        'time_expire' => time()+ 3600,
        'client_ip' => '127.0.0.1',
        'extra' => [],
    ],
    'balance_bonus' => [
        'amount' => 10,
    ],
    'from_user' => 'user_test_01',
    'description' => 'Your description',
    'metadata' => [],
]);
```

## 用户充值查询
```php
\Pingpp\Recharge::retrieve('221170807730968330240000')
```

## 查询用户充值列表
```php
$params = [
    'page' => 1,
    'per_page' => 100,
];
\Pingpp\Recharge::all($params);
```

## 用户充值退款
```php
\Pingpp\Recharge::refund('221170807730968330240000', [
    'description' => 'Rechage refund description',
]);
```

## 查询用户充值退款
```php
\Pingpp\Recharge::refund_retrieve('221170807730968330240000', 're_iTqLaTe1WTmHvXjrv9i5C8G4')
```

## 查询用户充值退款列表
```php
\Pingpp\Recharge::refundList('221170807730968330240000')
```


## 创建用户
```php
 \Pingpp\User::create(array(
    'id' => uniqid('uid'),          // 用户 ID ，由商户提供
 ));
```

## 查询用户
```php
\Pingpp\User::retrieve('uid582d35283f628');
```

## 更新用户
```php
\Pingpp\User::update($uid, array(
    'address' => 'China',
    'name' => strval(mt_rand(1000, 9999)),
    'metadata' => array(
        'key' => 'valeu'
    ),
));
```

## 查询用户列表
```php
$users = \Pingpp\User::all(array(
    'page' => 1,
    'per_page' => 10,
));
```

## 创建优惠券模板
```php
\Pingpp\CouponTemplate::create(array(
    'name'              => '25OFF',                // 优惠券模板名称
    'type'              => 2,                      // 优惠券模板的类型 1：现金券；2：折扣券
    'percent_off'       => 25,                     // 折扣百分比, 如 20 表示 8 折, 100 表示免费
    'amount_available'  => 10000,                  // 订单金额大于等于该值时，优惠券有效（适用于满减）；0 表示无限制
    'max_circulation'   => 1000,                   // 优惠券最大生成数量，当已生成数量达到最大值时，不能再生成优惠券；默认 null，表示可以无限生成
    'metadata'          => array(),                // metadata
    'expiration'        => null                    // 优惠券模板过期策略
));
```

## 查询优惠券模板列表
```php
\Pingpp\CouponTemplate::all(array(
    'page' => 1,
    'per_page' => 10
));
```

## 查询优惠券模板
```php
\Pingpp\CouponTemplate::retrieve('300116082415452100000700');
```

## 更新优惠券模板
```php
$ct = \Pingpp\CouponTemplate::update('300116082415452100000700', array(
    'metadata' => array(
        'keys' => 'value',
    )
));
```

## 删除优惠券模板
```php
\Pingpp\CouponTemplate::delete('300116082415452100000700');
```

## 批量创建优惠券
```php
$coupon_tmpl_id = '300216111711085500022401';                               // ping++返回的优惠券模板 ID
$params = array(
    'users' => array(
        'uid582d1756b1650',
        'uid582d1756b1651',
    )
);
\Pingpp\CouponTemplate::batchCreateCoupons($coupon_tmpl_id, $params);
```

## 查询优惠券模板下的优惠券列表
```php
\Pingpp\CouponTemplate::couponsList('300216111711085500022401');    //  ping++返回的优惠券模板 ID
```

## 创建单个优惠券
```php
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$params = array(
    'coupon_template' => '300216111619300600019101',                        // 优惠券模版 ID
);
\Pingpp\Coupon::create($user_id, $params);
```

## 查询优惠券
```php
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$coupon_id = '300416111711463500023901';                                    // 优惠券 ID
\Pingpp\Coupon::retrieve($user_id, $coupon_id);
```

## 更新优惠券
```php
//更新 Coupon 对象
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$coupon_id = '300416111711571500024101';                                    // 优惠券 ID
$params = array(
    'metadata' => array(
        'key' => 'value'
    )
);
\Pingpp\Coupon::update($user_id, $coupon_id, $params);
```   

## 删除优惠券
```php
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$coupon_id = '300416111711463500023901';                                    // 优惠券 ID
\Pingpp\Coupon::delete($user_id, $coupon_id);
```

## 查询用户优惠券列表
```php
$user_id = 'uid582d1756b1650';                                              // 用户 ID
$search_params = array(                                                          //搜索条件，此数组可以为空
    'page'      => 1,                                                       //页码，取值范围：1~1000000000；默认值为"1"
    'per_page'  => 2                                                        //每页数量，取值范围：1～100；默认值为"20"
);
\Pingpp\Coupon::all($user_id, $search_params);
```

## 批量提现确认
```php
$params = array(
    'withdrawals' => array(
        '1701611150302360654',
        '1701611151015078981'
    )
);
\Pingpp\BatchWithdrawal::confirm($params);
```
## 批量提现撤销
```php
$params = array(
    'withdrawals' => array(
        '1701611150302360654',
        '1701611151015078981'
    )
);
\Pingpp\BatchWithdrawal::cancel($params);

```

## 批量提现查询
```php
\Pingpp\BatchWithdrawal::retrieve('1901611151015122025');   //批量提现对象 ID。
```

## 批量提现列表查询
```php
$params = array(
    'per_page' => 20,
    'page' => 1
);
\Pingpp\BatchWithdrawal::all($params);
```

## 查询用户余额明细列表
```php
\Pingpp\BalanceTransaction::all([]);
```

## 查询用户余额明细
```php
\Pingpp\BalanceTransaction::retrieve('310216111501260200000601');
```

## 余额提现申请
```php
$params = array(
    "user" => 'u-s.e_r1479281694040',                       // 用户 ID
    "amount" => 200,                                        // 转账金额
    "channel" => 'unionpay',                                // 提现使用渠道。银联：unionpay，支付宝：alipay，微信：wx
    "user_fee" => 10,                                       // 用户需要承担的手续费
    "description" => "test232description",
    "order_no" => time() . mt_rand(11111, 99999),           // 提现订单号，为长度不大于 16 的数字
    "extra" => array(
        "card_number" => "6214888888888888",
        "user_name" => "张三",
        "open_bank_code" => "0102",
        "prov" => "上海",
        "city" => "上海"
    )
);
\Pingpp\Withdrawal::create($params);
```

## 余额提现查询
```php
\Pingpp\Withdrawal::retrieve('1711611161932569404');
```

## 余额提现列表查询
```php
\Pingpp\Withdrawal::all(array(
    'per_page' => 3
));
```

## 创建余额赠送
```php
\Pingpp\BalanceBonus::create([
    'amount' => 10,
    'description' => '余额赠送描述',
    'user' => 'user_test_01',
    'order_no' => substr(md5(time()), 0, 10),
]);
```

## 查询用户赠送
```php
\Pingpp\BalanceBonus::retrieve('651170807590953932800000');
```

## 查询用户余额赠送列表
```php
\Pingpp\BalanceBonus::all()
```

## 创建余额转账
```php
\Pingpp\BalanceTransfer::create(
    [
        'amount' => 10,
        'user_fee' => 0,
        'user' => 'user_001',
        'recipient' => '0',
        'order_no' => substr(md5(time()), 0, 10),
        'description' => 'Your description',
        'metadata' => [],
    ]
);
```

## 查询用户余额转账
```php
\Pingpp\BalanceTransfer::retrieve('661170807435256330240000');
```

## 查询用户余额转账列表
```php
\Pingpp\BalanceTransfer::all()
```

## 创建子商户
```php
\Pingpp\SubApp::create(array(
    'display_name' => 'sub_app_display_name',
    'user' => 'user_102',
    'metadata' => array(
        'key' => 'value'
    ),
));
```

## 查询子商户
```php
\Pingpp\SubApp::retrieve('app_1Gqj58ynP0mHeX1q');
```

## 查询子商户列表
```php
\Pingpp\SubApp::all();
```

## 更新子商户
```php
$sub_app = \Pingpp\SubApp::update('app_1Gqj58ynP0mHeX1q', array(
    'display_name' => 'display_name_2',
    'metadata' => array(
        'key' => 'value2'
    ),
    'description' => 'Your description',
));
```

## 删除子商户
```php
\Pingpp\SubApp::delete('app_1Gqj58ynP0mHeX1q');
```

## 设置子商户渠道参数
```php
\Pingpp\Channel::create('app_1Gqj58ynP0mHeX1q', [
    'channel' => 'alipay',
    'params' => [
        'fee_rate' => 60,
        'alipay_pid' => '2088501666666666',
        'alipay_account' => 'account@example.com',
        'alipay_security_key' => 'Your security_key',
        'alipay_mer_app_private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDSBOW3jdthyqSBMNJ8P+BQnfoKpL29BtvACW1gr8YhXh8EqpBU
nUDdQgi8uYnprXBbR5O1DVnIqLKG9loEn3Rc2iqpnj3M3nSShuVByjyJjQ+DAIG2
/cgJjGQknCLo0CKtuEIyD5xBKYVz3GLofLKqCNGDYdUIxwgaBBpssNIDGQIDAQAB
AoGBAKmzw1taiRawA9VQegRkKQF7ZXwMOjTvwcme1H74CYUU5MOEfzOgDbW7kgvN
cJ8dwlg/sh7uNsppZjif/4UUw5R7bSu33m1sIyglmKUYTU7Kw+ETVAPgwkQjJhek
V/pDr143vmchAblD4RqQZTneojTkvYgci4RkHHHIIZ8lClIBAkEA/nEyCKzl0gxU
LWMd0HKLctcwDu6NPWycffFzSg/+k1+h0GlSTp2E8J6DKOYnrlQYvK2/BnbFPfrb
EySi+7c86QJBANNOExrr7xl54JnlZxbXNDnNrql2brPk1DsV/3Lo3Tmt8NuVqiyo
hVE8Vs/CPRqTTSPoTV4TwSscB4Torlox9rECQB9tne+CY7TJPxCIIKOhsmXR/Kar
gpimtMG9tC7ewOQ1OMiEad06CbSq76p6m0YmLxQHJgRHYV+hf7Pin5sV7BkCQQC6
9KxAuJk/YC9R2r/AXL4vmoU8GLZP4lnIwWjXwaLiwryFfEEp7BywyINCpOgtWED7
UTEK2M2jl9QrSzfgQ66xAkBm2RI+8onm/4PVKtOt8tqLjfsFGMR3g0aUwgSbznc0
Xg9dfU+YUgqfQnyAQHt9jG3/SBdmIrYoWwb7TqJZLkZI
-----END RSA PRIVATE KEY-----',
        'alipay_app_public_key' => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDSBOW3jdthyqSBMNJ8P+BQnfoK
pL29BtvACW1gr8YhXh8EqpBUnUDdQgi8uYnprXBbR5O1DVnIqLKG9loEn3Rc2iqp
nj3M3nSShuVByjyJjQ+DAIG2/cgJjGQknCLo0CKtuEIyD5xBKYVz3GLofLKqCNGD
YdUIxwgaBBpssNIDGQIDAQAB
-----END PUBLIC KEY-----',
    ],
    'banned' => false,
    'banned_msg' => null,
    'description' => 'alipay description',
]);
```
## 获取子商户渠道参数
```php
\Pingpp\Channel::retrieve('app_1Gqj58ynP0mHeX1q', 'alipay');
```
## 更新子商户渠道参数
```php
\Pingpp\Channel::update('app_1Gqj58ynP0mHeX1q', 'alipay', [
    'description' => 'new description',
    'params' => [
        'fee_rate' => 50,
        'alipay_pid' => 'Your Alipay pid',
        'alipay_account' => 'account@example.com',
    ],
]);
```
## 删除子商户渠道参数
```php
\Pingpp\Channel::delete('app_1Gqj58ynP0mHeX1q', 'alipay');
```

## 创建结算账户对象
```php
\Pingpp\SettleAccount::create('user_004', array(
    'channel' => 'alipay',
    'recipient' => array(
        'type' => 'b2c', //转账类型。b2c：企业向个人付款，b2b：企业向企业付款。
        'account' => 'account01@account.com',
        'name' => '李狗',
    ),
));
```

## 查询结算账户对象
```php
\Pingpp\SettleAccount::retrieve('user_008', '320217031816231000001001');
```

## 删除结算账户对象
```php
$delete_sa = \Pingpp\SettleAccount::delete('user_008', '320217031816231000001001');
```

## 查询结算账户对象列表
```php
\Pingpp\SettleAccount::all('user_008');
```
## 批量更新分润对象
```php
$royalties = \Pingpp\Royalty::update(array(
    'ids' => array(
        '170301124238000111',
        '170301124238000211'
    ),
    'method' => 'manual', //手动标记结算: manual 或 取消手动标记结算：null
    'description' => 'Your description',
));
```

## 查询分润对象
```php
\Pingpp\Royalty::retrieve('411170318160900002');
```

## 查询分润列表
```php
\Pingpp\Royalty::all();
```

## 创建分润结算对象
```php
\Pingpp\RoyaltySettlement::create(array(
    'payer_app' => APP_ID,
    'method' => 'alipay',   //分润的方式，余额 balance 或渠道名称，例如 alipay
    'recipient_app' => APP_ID,
    'created' => array(
        'gt' => 1489826451,
        'lt' => 1492418451,
    ),
    'source_user' => 'user_002',
    //'source_no' => '',
    'min_amount' => 1,
    'metadata' => array(
        'key' => 'value'
    ),
));
```

## 查询分润结算对象
```php
\Pingpp\RoyaltySettlement::retrieve('431170318144700001');
```

## 更新分润结算对象
```php
\Pingpp\RoyaltySettlement::update('431170318144700001', array(
    'status' => 'pending'  // pending, canceled
));
```

## 获取分润结算对象列表
```php
\Pingpp\RoyaltySettlement::all(array(
    'payer_app' => APP_ID
));
```

## 查询分润结算明细对象
```php
\Pingpp\RoyaltyTransaction::retrieve('441170318144700002');
```

## 查询分润结算明细对象列表
```php
\Pingpp\RoyaltyTransaction::all();
```

## 创建分润模板
```php
\Pingpp\RoyaltyTemplate::create(
    [
        'app' => \Pingpp\Pingpp::getAppId(),
        'name' => 'royalty_template_name',
        'rule' => [
            'royalty_mode' => 'rate',
            'refund_mode' => 'no_refund',
            'allocation_mode' => 'receipt_reserved',
            'data' => [
                ['level' => 1, 'value' => 30],
                ['level' => 2, 'value' => 20],
                ['level' => 3, 'value' => 10],
            ],
        ],
        'description' => 'Your description',
    ]
);
```

## 查询分润模板
```php
\Pingpp\RoyaltyTemplate::retrieve('451170807182300001')
```

## 更新分润模板
```php
\Pingpp\RoyaltyTemplate::update('451170807182300001', [
    'name' => 'royalty_template_name_new',
    'rule' => [
        'royalty_mode' => 'fixed',
        'refund_mode' => 'full_refund',
        'allocation_mode' => 'service_reserved',
        'data' => [
            ['level' => 1, 'value' => 33],
            ['level' => 2, 'value' => 22],
            ['level' => 3, 'value' => 11],
        ],
    ],
    'description' => 'Your description',
]);
```

## 查询分润模板
```php
\Pingpp\RoyaltyTemplate::retrieve('451170807182300001')
```

## 删除分润模板
```php
\Pingpp\RoyaltyTemplate::delete('451170807182300001')
```

## 查询分润模板列表
```php
\Pingpp\RoyaltyTemplate::all()
```
