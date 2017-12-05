<?php

namespace Pingpp;

/**
 * 分润结算明细对象
 * Class RoyaltyTransaction
 * @package Pingpp
 */
class RoyaltyTransaction extends ApiResource
{
    public static function className()
    {
        return 'royalty_transaction';
    }

    /**
     * 查询分润结算明细对象
     * @param $royalty_transaction_id
     * @param $options
     * @return static
     */
    public static function retrieve($royalty_transaction_id, $options = null)
    {
        return static::_retrieve($royalty_transaction_id, $options);
    }

    /**
     * 查询分润结算明细对象列表
     * @param null $params
     * @param $options
     * @return array|PingppObject
     */
    public static function all($params = null, $options = null)
    {
        return static::_all($params, $options);
    }
}