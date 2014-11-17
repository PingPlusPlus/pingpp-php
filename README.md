Pingpp PHP SDK
=================

****

##简介

lib 文件夹下是 PHP SDK 文件，<br>
example 文件夹里面是一个简单的接入示例，该示例仅供参考。

##版本要求

PHP SDK 要求 PHP 5.3 及以上版本

##接入方法

关于如何使用 SDK 请参考 [技术文档](https://pingplusplus.com/document) 或者参考 [example](https://github.com/PingPlusPlus/pingpp-sdk/tree/master/pingpp-php/example) 文件夹里的示例。

##更新日志

###1.0.2
* 更改：<br>
cURL 使用 TLSv1.x

###1.0.3
* 更改：<br>
所有 PingPP 改成 Pingpp<br>
Pingpp_Object 转成 JSON 时，用 stdClass 代替 array

###1.0.4
* 更改：<br>
移除旧的 refund 方法