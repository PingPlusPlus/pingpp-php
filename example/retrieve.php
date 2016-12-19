<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 接入查询流程参考开发者中心：https://www.pingxx.com/docs/server ，文档可筛选后端语言和接入渠道。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require 'config.php';
// 设置 API Key
\Pingpp\Pingpp::setApiKey(APP_KEY);

// 通过 Charge 对象的 id 查询一个已创建的 Charge 对象
$ch = \Pingpp\Charge::retrieve('ch_a9CmfHTGGaz1urHiL8m5OiX1');
echo $ch;// 输出 Ping++ 返回 Charge 对象
