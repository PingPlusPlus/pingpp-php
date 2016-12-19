<?php
/**
 * Created by PhpStorm.
 * User: shenlin
 * Date: 15/5/14
 * Time: 17:30
 */

require dirname(__FILE__) . '/../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require 'config.php';
// 设置 API Key
\Pingpp\Pingpp::setApiKey(APP_KEY);

// 查询指定的 event 对象，通过 event 对象的 id 查询一个已创建的 event 对象
$evt = \Pingpp\Event::retrieve('evt_zRFRk6ekazsH7t7yCqEeovhk');
echo $evt;
