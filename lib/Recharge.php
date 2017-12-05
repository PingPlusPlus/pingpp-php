<?php

namespace Pingpp;

class Recharge extends AppBase
{
    public static function getRechargeRefundInstanceUrl($recharge_id, $refund_id = null)
    {
        $url = static::classUrl() . '/' . $recharge_id . '/refunds';
        if (!empty($refund_id)) {
            $url .= '/' . $refund_id;
        }
        return $url;
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     * @return Recharge The created Recharge.
     */
    public static function create($params, $options = null)
    {
        return static::_create($params, $options);
    }

    /**
     * @param $recharge_id string $id The ID of the Recharge to retrieve.
     * @param array|string|null $params
     * @param array|string|null $options
     * @return Recharge
     */
    public static function retrieve($recharge_id, $params = null, $options = null)
    {
        return static::_retrieve($recharge_id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of Recharge.
     */
    public static function all($params = null, $options = [])
    {
        return static::_all($params, $options);
    }

    /**
     * @param $recharge_id string $recharge_id The ID of the Recharge.
     * @param array|null $params
     * @param array|string|null $options
     * @return Refund The created Refund.
     */
    public static function refund($recharge_id, $params = [], $options = null)
    {
        $url = static::getRechargeRefundInstanceUrl($recharge_id);
        return static::_directRequest('post', $url, $params, $options);
    }

    /**
     * @param $recharge_id string $recharge_id The ID of the Recharge.
     * @param $refund_id string The ID of the Refund
     * @param array|null $options
     * @return Refund The created Refund.
     */
    public static function refundRetrieve($recharge_id, $refund_id, $options = [])
    {
        $url = static::getRechargeRefundInstanceUrl($recharge_id, $refund_id);
        return static::_directRequest('get', $url, null, $options);
    }

    /**
     * @param $recharge_id string $recharge_id The ID of the Recharge.
     * @param array|string|null $options
     * @return array an Array of Refund List.
     */
    public static function refundList($recharge_id, $options = [])
    {
        $url = static::getRechargeRefundInstanceUrl($recharge_id);
        return static::_directRequest('get', $url, null, $options);
    }
}
