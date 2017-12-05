<?php

namespace Pingpp;

class OrderRefund extends ApiResource
{

    public static function className()
    {
        return 'order_refund';
    }

    public static function classUrlWithOrderId($orId)
    {
        return Order::instanceUrlWithId($orId) . '/order_refunds';
    }

    public static function instanceUrlWithOrderRefundId($orId, $orReId)
    {
        $orReId = Util\Util::utf8($orReId);
        $base = static::classUrlWithOrderId($orId);
        $extn = urlencode($orReId);
        return  $base . '/' . $extn;
    }

    public static function all($orId, $params = null, $opts = null)
    {
        $url = static::classUrlWithOrderId($orId);
        return static::_directRequest('get', $url, $params, $opts);
    }

    public static function create($order_id, $params = null, $opts = null)
    {
        $url = self::classUrlWithOrderId($order_id);
        return static::_directRequest('post', $url, $params, $opts);
    }

    public static function retrieve($order_id, $refund_id, $opts = null)
    {
        $url = static::instanceUrlWithOrderRefundId($order_id, $refund_id);
        return static::_directRequest('get', $url, array(), $opts);
    }
}
