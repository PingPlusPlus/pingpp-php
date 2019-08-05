<?php
/**
 * Ping++ Server SDK
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 * 该代码仅供学习和研究 Ping++ SDK 使用，仅供参考。
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';
// 示例配置文件，测试请根据文件注释修改其配置
require dirname(__DIR__) . '/config.php';

// 存管添加联系人
$user_pic = \Pingpp\UserPic::upload([
    "user" => "test_user_001", // 用户 ID，首字母必须是英文数字或者 _-@, 必传
    "type" => "customer", // 用户类型，customer: 对私，business: 对公
    "acc_no" => "2019057929311601000631", // 壹账通用户编号。覆盖的时候使用，新用户不需要该字段
    "operate_type" => "00", // 操作类型，00: 新增，01: 修改，02: 增开户。不传默认为新增
        // 图片内容，base64 编码
    "pic" => base64_encode(file_get_contents(__DIR__ . '/id-102.jpg')),
    "pic_fmt" => "jpg", // 图片格式。jpg, png
    "pic_type" => "102", // 图片类型，101: 个人身份证信息面，102: 个人身份证国徽面，201: 企业证件照片，202: 法人身份证信息面，203: 法人身份证国徽面
]);

echo $user_pic;
