<?php

class WxpubOAuth
{
    public static function getOpenid($app_id, $app_secret, $code, $more_info=FALSE)
    {
        $url = WxpubOAuth::_createOauthUrlForOpenid($app_id, $app_secret, $code, $more_info);

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