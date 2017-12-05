<?php

namespace Pingpp;

class CouponTemplate extends AppBase
{

    public static function className()
    {
        return 'coupon_template';
    }

    /**
     * @param string $id The ID of the user to retrieve.
     * @param array|string|null $options
     *
     * @return CouponTemplate
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of coupon templates.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return CouponTemplate The created coupon template.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param array|string|null $options
     *
     * @return CouponTemplate The saved coupon template.
     */
    public function save($options = null)
    {
        return $this->_save($options);
    }

    /**
     * @param $id
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return coupon
     */
    public static function batchCreateCoupons($id, $params = null, $options = null)
    {
        $url = static::classUrl() . '/' . $id . '/coupons';
        return static::_directRequest('post', $url, $params, $options);
    }

    /**
     * @param $id
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return coupon
     */
    public static function couponsList($id, $params = null, $options = null)
    {
        $url = static::classUrl() . '/' . $id . '/coupons';
        return static::_directRequest('get', $url, $params, $options);
    }

    public static function update($id, $params)
    {
        $url = static::classUrl() . '/' . $id;
        return static::_directRequest('put', $url, $params);
    }

    /**
     * delete coupontemplate
     * @param $id
     * @param $options
     * @return array|PingppObject
     */
    public static function delete($id, $options = null)
    {
        $url = static::classUrl() . '/' . $id;
        return static::_directRequest('delete', $url, $options);
    }
}
