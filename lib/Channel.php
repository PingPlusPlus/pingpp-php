<?php

namespace Pingpp;

/**
 * 子商户应用支付渠道
 * Class Channel
 * @package Pingpp
 */
class Channel extends AppBase
{
    public static function classUrlWithSubAppId($sub_app_id)
    {
        return SubApp::instanceUrlWithId($sub_app_id) . '/channels';
    }

    public static function instanceUrlWithChannel($sub_app_id, $channel)
    {
        $channel = Util\Util::utf8($channel);
        $base = static::classUrlWithSubAppId($sub_app_id);
        $channel = urlencode($channel);
        return $base . '/' . $channel;
    }

    /**
     * 创建子商户应用支付渠道
     * @param $sub_app_id
     * @param $params
     * @param $options
     * @return array|PingppObject
     */
    public static function create($sub_app_id, $params, $options = null)
    {
        $url = static::classUrlWithSubAppId($sub_app_id);
        return static::_directRequest('post', $url, $params, $options);
    }

    /**
     * 查询子商户应用支付渠道
     * @param $sub_app_id
     * @param $channel
     * @param $options
     * @return array|PingppObject
     */
    public static function retrieve($sub_app_id, $channel, $options = null)
    {
        $url = static::instanceUrlWithChannel($sub_app_id, $channel);
        return static::_directRequest('get', $url, array(), $options);
    }

    /**
     * 更新子商户应用支付渠道
     * @param $sub_app_id
     * @param $channel
     * @param null $params
     * @param $options
     * @return array|PingppObject
     */
    public static function update($sub_app_id, $channel, $params = null, $options = null)
    {
        $url = static::instanceUrlWithChannel($sub_app_id, $channel);
        return static::_directRequest('put', $url, $params, $options);
    }

    /**
     * 删除子商户应用支付渠道
     * @param $sub_app_id
     * @param $channel
     * @param null $params
     * @param $options
     * @return array|PingppObject
     */
    public static function delete($sub_app_id, $channel, $params = null, $options = null)
    {
        $url = static::instanceUrlWithChannel($sub_app_id, $channel);
        return static::_directRequest('delete', $url, $params, $options);
    }
}