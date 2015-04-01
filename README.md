Pingpp PHP SDK
=================
## 简介
lib 文件夹下是 PHP SDK 文件，<br>
example 文件夹里面是简单的接入示例，该示例仅供参考。

## 版本要求
PHP 版本 5.2 及以上

##安装
```
php composer.phar install pingpp
```

或者使用源码构建：
将 lib 文件导入工程


## 接入方法

### 初始化
```php
require_once(dirname(__FILE__) . '/../init.php');
\Pingpp\Pingpp::setApiKey('YOUR-KEY');
```

### 支付
```php
\Pingpp\Charge::create();
```

### 查询
```php
\Pingpp\Charge::retrieve('{CHARGE_ID}');
```

```php
\Pingpp\Charge::all();
```

### 退款
``` php
$ch->refunds->create();
```

### 退款查询

```php
$charge->refunds->retrieve({REFUND_ID});
```

```php
\Pingpp\Charge::retrieve({CHARGE_ID})->refunds->all();
```

### 微信红包
```php
\Pingpp\RedEnvelope::create();
```

### 查询
```php
\Pingpp\RedEnvelope::retrieve('{RED_ID}');
```

```php
\Pingpp\RedEnvelope::all();
```

**详细信息请参考 [API 文档](https://pingxx.com/document/api?php)。**
