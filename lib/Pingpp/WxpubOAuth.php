<?php


/**
 * 用于微信公众号OAuth2.0鉴权，用户授权后获取授权用户唯一标识openid
 * WxpubOAuth中的方法都是可选的，开发者也可根据实际情况自行开发相关功能，
 * 详细内容可参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html
 */
class WxpubOAuth
{
    /**
     * 获取微信公众号授权用户唯一标识
     * @param $app_id 微信公众号应用唯一标识
     * @param $app_secret 微信公众号应用密钥（注意保密）
     * @param $code 授权code, 通过调用WxpubOAuth::createOauthUrlForCode来获取
     * @return openid 微信公众号授权用户唯一标识, 可用于微信网页内支付
     */
    public static function getOpenid($app_id, $app_secret, $code)
    {
        $url = WxpubOAuth::_createOauthUrlForOpenid($app_id, $app_secret, $code);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $res = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($res,true);

        return $data['openid'];
    }

    /**
     * 用于获取授权code的URL地址，此地址用于用户身份鉴权，获取用户身份信息，同时重定向到$redirect_url
     * @param $app_id 微信公众号应用唯一标识
     * @param $redirect_url 授权后重定向的回调链接地址，重定向后此地址将带有授权code参数，
     *                      该地址的域名需在微信公众号平台上进行设置，
     *                      步骤为：登陆微信公众号平台 => 开发者中心 => 网页授权获取用户基本信息 => 修改
     * @param bool $more_info FALSE 不弹出授权页面,直接跳转,这个只能拿到用户openid
     *                        TRUE 弹出授权页面,这个可以通过 openid 拿到昵称、性别、所在地，
     * @return string 用于获取授权code的URL地址
     */
    public static function createOauthUrlForCode($app_id, $redirect_url, $more_info=FALSE)
    {
        $urlObj["appid"] = $app_id;
        $urlObj["redirect_uri"] = "$redirect_url";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = $more_info ? "snsapi_userinfo" : "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $queryStr = http_build_query($urlObj);

        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$queryStr;
    }

    /**
     * 获取openid的URL地址
     * @param $app_id 微信公众号应用唯一标识
     * @param $app_secret 微信公众号应用密钥（注意保密）
     * @param $code 授权code, 通过调用WxpubOAuth::createOauthUrlForCode来获取
     * @return string 获取openid的URL地址
     */
    private static function _createOauthUrlForOpenid($app_id, $app_secret, $code)
    {
        $urlObj["appid"] = $app_id;
        $urlObj["secret"] = $app_secret;
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $queryStr = http_build_query($urlObj);

        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$queryStr;
    }
}