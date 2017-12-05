<?php

namespace Pingpp;

/**
 * Class SubApp 子商户对象
 * @package Pingpp
 */
class SubApp extends AppBase
{
    public static function className()
    {
        return 'sub_app';
    }

    /**
     * 创建子商户对象
     * @param $params
     * @param $options
     * @return array|PingppObject
     */
    public static function create($params, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * 查询子商户对象
     * @param $sub_app_id
     * @param $options
     * @return static
     */
    public static function retrieve($sub_app_id, $options = null)
    {
        return self::_retrieve($sub_app_id, $options);
    }

    /**
     * 查询所有的子商户对象列表
     * @param $params
     * @param $options
     * @return array|PingppObject
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * 删除子商户对象
     * @param $sub_app_id
     * @param $options
     * @return $this
     */
    public static function delete($sub_app_id, $options = null)
    {
        return self::_delete($sub_app_id, $options);
    }

    /**
     *  更新子商户对象
     * @param $sub_app_id
     * @param $params
     * @param $options
     * @return array|PingppObject
     */
    public static function update($sub_app_id, $params, $options = null)
    {
        $url = static::instanceUrlWithId($sub_app_id);
        return static::_directRequest('put', $url, $params, $options);
    }
}
