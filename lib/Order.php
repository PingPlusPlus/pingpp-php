<?php

namespace Pingpp;

class Order extends ApiResource
{

    /**
     * @param string $id The ID of the order to retrieve.
     * @param array|string|null $opts
     *
     * @return Order
     */
    public static function retrieve($id, $opts = null)
    {
        return self::_retrieve($id, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return array An array of Order.
     */
    public static function all($params = null, $opts = null)
    {
        return self::_all($params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Order The created order.
     */
    public static function create($params = null, $opts = null)
    {
        return self::_create($params, $opts);
    }

    /**
     * @param array|string|null $opts
     *
     * @return Order The saved order.
     */
    public function save($opts = null)
    {
        return $this->_save($opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Order
     */
    public static function pay($order_id, $params = null, $opts = null)
    {
        $url = static::instanceUrlWithId($order_id) . '/pay';
        return static::_directRequest('post', $url, $params, $opts);
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return Order the canceled order
     */
    public static function cancel($order_id, $params = null, $opts = null)
    {
        $url = static::instanceUrlWithId($order_id);
        if (empty($params)) {
            $params = ['status' => 'canceled'];
        } else {
            $params = array_merge($params, ['status' => 'canceled']);
        }
        return static::_directRequest('put', $url, $params, $opts);
    }

    /**
     * @param $order_id
     * @param $charge_id
     * @param null $opts
     * @return array|Charge
     */
    public static function chargeRetrieve($order_id, $charge_id, $opts = null)
    {
        $url = static::instanceUrlWithId($order_id) . '/charges/' . $charge_id;
        return static::_directRequest('get', $url, null, $opts);
    }

    public static function chargeList($order_id, $params = null, $opts = null)
    {
        $url = static::instanceUrlWithId($order_id) . '/charges';
        return static::_directRequest('get', $url, $params, $opts);
    }
}
