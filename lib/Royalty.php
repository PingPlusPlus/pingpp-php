<?php

namespace Pingpp;

/**
 * 分润对象
 * Class Royalty
 * @package Pingpp
 */
class Royalty extends ApiResource
{
    public static function className()
    {
        return 'royaltie';
    }

    /**
     * 批量更新分润对象
     * @param $params
     * @param $options
     * @return Royalty
     */
    public static function update($params, $options = null)
    {
        $url = static::classUrl();
        return static::_directRequest('put', $url, $params, $options);
    }

    /**
     * 查询分润对象
     * @param $royalty_id
     * @param $options
     * @return Royalty
     */
    public static function retrieve($royalty_id, $options = null)
    {
        return static::_retrieve($royalty_id, $options);
    }

    /**
     * 查询分润对象列表
     * @param null $params
     * @param $options
     * @return List
     */
    public static function all($params = null, $options = null)
    {
        return static::_all($params, $options);
    }
}