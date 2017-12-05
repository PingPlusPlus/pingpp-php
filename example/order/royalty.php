<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(__FILE__) . '/../../init.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__FILE__) . '/../config.php';

/**
 * 分润对象 SDK示例
 */

// 批量更新分润对象
$royalties = \Pingpp\Royalty::update([
    'ids' => [
        '170301124238000111',
        '170301124238000211'
    ],
    'method' => 'manual', //手动标记结算: manual 或 取消手动标记结算：null
    'description' => 'Your description',
]);

echo $royalties;
exit;

//查询分润对象列表
$royalties = \Pingpp\Royalty::all();
echo $royalties;
exit;

//查询分润对象
$royalties = \Pingpp\Royalty::retrieve('411170318160900002');
echo $royalties;