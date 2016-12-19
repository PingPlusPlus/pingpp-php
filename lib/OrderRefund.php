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

    public static function classUrlWithOrderId($orId)
    {
        return Order::instanceUrlWithId($orId) . '/refunds';
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

    public static function create($orId, $params = null, $opts = null)
    {
        $url = static::classUrlWithOrderId($orId);
        return static::_directRequest('post', $url, $params, $opts);
    }

    public static function retrieve($orId, $orReId, $opts = null)
    {
        $url = static::instanceUrlWithOrderRefundId($orId, $orReId);
        return static::_directRequest('get', $url, array(), $opts);
    }
}
