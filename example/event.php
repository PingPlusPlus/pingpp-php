<?php
/**
 * Created by PhpStorm.
 * User: shenlin
 * Date: 15/5/14
 * Time: 17:30
 */

require dirname(__FILE__) . '/../init.php';

// api_key 获取方式：登录 [Dashboard](https://dashboard.pingxx.com)->点击管理平台右上角公司名称->开发信息-> Secret Key
\Pingpp\Pingpp::setApiKey('sk_test_ibbTe5jLGCi5rzfH4OqPW9KC');

// 查询指定的 event 对象，通过 event 对象的 id 查询一个已创建的 event 对象
$evt = \Pingpp\Event::retrieve('evt_zRFRk6ekazsH7t7yCqEeovhk');
echo $evt;

// 查询 event 列表，返回之前创建 event 对象的一个列表。列表是按创建时间进行排序，总是将最新的 event 对象显示在最前
$evts = \Pingpp\Event::all(array('type' => 'charge.succeeded'));
echo $evts;
