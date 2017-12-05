# ChangeLog

## 2.4.1
#### 修改
- api http 请求返回 502 请求重试一次

---
## 2.4.0
#### 新增
- recharge 充值接口
- royalty_templates 分润模板接口
- balance_transfers 余额转账接口
- balance_bonus 余额赠送接口
- order_refunds 订单退款接口
- charges/refunds 创建/查询订单charge和退款接口

#### 修改
- 分润结算新增预览参数
- 提现创建接口新增settle_account 参数, channel,extra 参数由必填修改为选填.
- order退款列表order_refund变更为refund对象,order消费订单支持charge接口退款,
- 原order退款创建、查询列表返回的order_refund变更为refund对象.
- order对象新增charge对象列表，actual_amount参数;
- 订单支付接口支持传商户订单号,此时支付的商户订单号不等于订单的商户订单号
- 提现创建接口新增settle_account 参数, channel,extra 参数由必填修改为选填.
- 原/v1/recharge 接口废弃,请使用新用户余额充值接口
- 原用户余额转账transfers 接口废弃请使用 balance_transfers 接口
- 原余额提现withdrawals废弃 请使用/v1/apps/APP_ID/withdrawals 接口
- 原余额收款接口 receipts 废弃,请使用 balance_bonus 接口
- 原 asset_transactions transaction_statistics接口下线.

---
## 2.3.1
#### 修改
- 修复用户查询接口 查询id为0的用户提示无效的id
- 新增线下渠道 isv_scan、isv_qr、isv_wap
- 新增 charge reverse 接口

---
## 2.3.0
#### 新增
- sub_app接口
- sub_app 设置渠道参数channel 接口
- settle_account 接口
- royaltie 分润对象接口
- royalty_settlement 接口
- 分润结算明细对象 接口

#### 修改
- order创建参数uid修改为可选参数, 返回order对象新增receipt_app,service_app,,available_methods
- 去除 fee 和 user_fee 字段,新增method、order_no、transaction_no source_url字段,查询列表新增 method order_no transaction_no asset_account 参数
- Asset Transaction Statistics 新增 user_fee_total user_fee_recharge user_fee_balance_transfer
- charge refund ,order refund ,coupontemplate refund的更新接口修改为update()

---
## 2.2.0
#### 新增
- coupons 接口
- coupon_templates 接口
- batch_transfers 接口
- batch_withdrawals 接口
- transaction_statistics 接口

---
## 2.1.5
#### 新增
- transfer 更新接口

## 2.1.4
#### 新增
- identification 接口

## 2.1.3
#### 修改
- 更正本地 CA 证书

## 2.1.2
#### 修改
- 更新本地 CA 证书
- 添加请求签名

## 2.1.1
#### 修改
- 添加 PUT 方法
- 添加 JSON 序列化方法

## 2.1.0
#### 增加
- 应用内快捷支付对应接口

## 2.0.7
#### 修改
- 补充 channel_error 错误类型

## 2.0.6
#### 增加
- 微信企业付款 transfer

## 2.0.5
#### 增加
- 京东手机网页支付
- event 查询和 event 列表查询

## 2.0.4
#### 更改
- 微信公众号获取 JS-SDK 签名兼容 nginx

## 2.0.3
#### 增加
- 增加微信公众号获取 JS-SDK 签名的接口

## 2.0.2
#### 增加
- 新增微信红包

## 2.0.1
#### 更改
- 添加 composer 支持，调用方法变更，具体请参考 [example](/example)

## 2.0.0
#### 更改
- 添加新渠道：百付宝、百付宝WAP、微信公众号支付

## 1.0.4
#### 更改
- 移除旧的 refund 方法

## 1.0.3
#### 更改
- 所有 PingPP 改成 Pingpp
- Pingpp_Object 转成 JSON 时，用 stdClass 代替 array

## 1.0.2
#### 更改
- cURL 使用 TLSv1.x
