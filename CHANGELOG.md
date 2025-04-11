# ChangeLog

## 2.6.0

- 新增 transfer 撤销接口
- 新增 资金充值申请创建和查询接口

## 2.5.1

#### 修改

- 更正本地 CA 证书

## 2.5.0

- 修复charge查询对象转换为字符串时在PHP7.4版本 notice 报错

## 2.4.9

2019-11-05

#### 新增

- 独立创建分润接口

## 2.4.8

2019-08-05

#### 新增

- 存管相关接口，证件上传、添加联系人、更新结算账号、结算账号更新手机号、结算账号验证打款

## 2.4.7

2019-05-30

#### 新增

- 分账接收方接口
- 分账明细接口
- 分账接口
- 支行列表查询接口 (SubBank)

## 2.4.6

2018-12-28

#### 修改

- 更新取消签约接口,添加微信取消签约示例

## 2.4.5

2018-09-13

#### 修改

- 修复主版本号与tag不一致问题

## 2.4.4

2018-05-22

#### 修改

- 修复 sub_app 删除接口报错

## 2.4.3

2018-05-14

#### 新增

- 新增 balance settlements 对象查询和列表接口
- 新增 card info 查询接口
- 添加设置自定义 CA 证书路径方法
- 微信小程序获取 openid 示例
- 新增渠道签约接口

#### 修改

- 修复 user 对象id 值为`0` 的情况下转换后对象中没有id

---

## 2.4.2

2018-01-10

#### 修改

- 移除 transfer、batch transfer 的 cancel 接口
- 示例：新增 charge 渠道 alipay_scan、wx_pub_scan、cb_alipay、cb_wx、cb_wx_pub、cb_wx_pub_qr、cb_wx_pub_scan
- 示例：移除 order pay balance_amount 字段

## 2.4.1

2017-12-05

#### 新增

- 合并账户系统接口

---

## 2.2.3

2017-06-15

#### 修改

- 新增线下渠道 isv_scan、isv_qr、isv_wap
- 新增 charge reverse 接口

---

## 2.2.2

2017-04-25

#### 修改

- 独立各个渠道文件并单独说明，提高 SDK 接入体验

---

## 2.2.1

2016-12-29

#### 新增

- batch_transfer 接口支持 cancel 操作（unionpay适用）

---

## 2.2.0

2016-12-16

#### 新增

- batch_transfer 接口
- batch_refund 接口
- customs 接口

#### 修改

- 删除 Customer、Card、CardInfo、Source、Token、SmsCode

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
