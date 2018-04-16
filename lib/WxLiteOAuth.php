<?php

namespace Pingpp;

/**
 * 获取授权用户信息
 * 开发者服务器使用临时登录凭证 code 获取 session_key 和 openid 等。
 * 详细内容可参考 https://developers.weixin.qq.com/miniprogram/dev/api/api-login.html
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可根据自己网站需求按照技术文档编写, 并非一定要使用该代码。
 */

class WxLiteOAuth
{
    /**
     * 获取 openid
     * @param string $app_id  微信小程序应用唯一标识
     * @param string $app_secret  微信小程序应用密钥（注意保密）
     * @param string $code  授权code, 登录时获取的 code
     * @return string openid
     */
    public static function getOpenid($app_id, $app_secret, $code)
    {
        return self::getSession($app_id, $app_secret, $code)['openid'];
    }

    /**
     * 获取 session_key 和 openid 等
     * @param string $app_id  微信小程序应用唯一标识
     * @param string $app_secret  微信小程序应用密钥（注意保密）
     * @param string $code  授权code, 登录时获取的 code
     * @return  array
     * 正常返回数组
     * [
     *    'openid' => 'OPENID',
     *    'session_key' => 'SESSIONKEY'
     * ]
     *
     * 满足 UnionID 返回条件时返回数组
     * [
     *    'openid' => 'OPENID',
     *    'session_key' => 'SESSIONKEY',
     *    'unionid' => 'UNIONID'
     * ]
     */
    public static function getSession($app_id, $app_secret, $code)
    {
        $url_params = [
            'appid'     => $app_id,
            'secret'    => $app_secret,
            'js_code'   => $code,
            'grant_type'=> 'authorization_code',
        ];
        $query_str = http_build_query($url_params);
        $url = 'https://api.weixin.qq.com/sns/jscode2session?' . $query_str;

        $res = self::getRequest($url);
        if (empty($res)) {
            throw new Error\Api("connect error");
        }
        $data = json_decode($res, true);
        if (!isset($data['openid']) || isset($data['errcode'])) {
            throw new Error\Api($res);
        }
        return $data;
    }


    /**
     * GET 请求
     */
    private static function getRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

}