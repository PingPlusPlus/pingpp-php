<?php

namespace Pingpp;

/**
 * 分润结算对象
 * Class RoyaltySettlement
 * @package Pingpp
 */
class RoyaltySettlement extends ApiResource
{
    public static function className()
    {
        return 'royalty_settlement';
    }

    /**
     * 创建分润结算对象
     * @param $params
     * @param $options
     * @return RoyaltySettlement
     */
    public static function create($params, $options = null)
    {
        return static::_create($params, $options);
    }

    /**
     * 查询分润结算对象
     * @param $royalty_settlement_id
     * @param $options
     * @return RoyaltySettlement
     */
    public static function retrieve($royalty_settlement_id, $options = null)
    {
        return static::_retrieve($royalty_settlement_id, $options);
    }

    /**
     * 更新分润结算对象
     * @param $royalty_settlement_id
     * @param $params
     * @return array|PingppObject
     */
    public static function update($royalty_settlement_id, $params, $options = null)
    {
        $url = static::instanceUrlWithId($royalty_settlement_id);
        return static::_directRequest('put', $url, $params, $options);
    }

    /**
     * 查询分润结算对象列表
     * @param null $params
     * @param $options
     * @return array|PingppObject
     */
    public static function all($params = null, $options = null)
    {
        return static::_all($params, $options);
    }
}