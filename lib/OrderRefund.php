<?php

namespace Pingpp;

class OrderRefund extends ApiResource
{

    public static function className()
    {
        return 'order_refund';
    }

    /**
     * @return string The API URL for this Pingpp order_refund.
     */
    public function instanceUrl()
    {
        $id = $this['id'];
        $order = $this['order'];
        if (!$id) {
            throw new Error\InvalidRequest(
                "Could not determine which URL to request: " .
                "class instance has invalid ID: $id",
                null
            );
        }
        $id = Util\Util::utf8($id);
        $order = Util\Util::utf8($order);

        $base = Order::classUrl();
        $orderExtn = urlencode($order);
        $extn = urlencode($id);
        return "$base/$orderExtn/refunds/$extn";
    }

    public static function classUrlWithOrderId($or_id)
    {
        return Order::instanceUrlWithId($or_id) . '/refunds';
    }

    public static function instanceUrlWithOrderRefundId($or_id, $or_re_id)
    {
        $or_re_id = Util\Util::utf8($or_re_id);
        $base = static::classUrlWithOrderId($or_id);
        $extn = urlencode($or_re_id);
        return  $base . '/' . $extn;
    }

    public static function all($or_id, $params = null, $opts = null)
    {
        $url = static::classUrlWithOrderId($or_id);
        return static::_directRequest('get', $url, $params, $opts);
    }

    public static function create($or_id, $params = null, $opts = null)
    {
        $url = static::classUrlWithOrderId($or_id);
        return static::_directRequest('post', $url, $params, $opts);
    }

    public static function retrieve($or_id, $or_re_id, $opts = null)
    {
        $url = static::instanceUrlWithOrderRefundId($or_id, $or_re_id);
        return static::_directRequest('get', $url, array(), $opts);
    }
}
