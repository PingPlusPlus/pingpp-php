<?php

namespace Pingpp;

class Coupon extends UserBase
{
    /**
     * @param string $id The ID of the coupon to retrieve.
     * @param array|string|null $options
     *
     * @return Coupon
     */
    public static function retrieve($userId, $id, $options = null)
    {
        return self::_userBasedRetrieve($userId, $id, $options);
    }

    /**
     * @param string $userId
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Coupon The created coupon.
     */
    public static function create($userId, $params = null, $options = null)
    {
        return self::_userBasedCreate($userId, $params, $options);
    }

    /**
     * @param string $userId
     * @param string $id  API resource ID
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Coupon The updated coupon.
     */
    public static function update($userId, $id, $params = null, $options = null)
    {
        return self::_userBasedUpdate($userId, $id, $params, $options);
    }

    /**
     * @param string $userId
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of coupon.
     */
    public static function all($userId, $params = null, $options = null)
    {
        return self::_userBasedList($userId, $params, $options);
    }

    /**
     * @param $userId
     * @param string $id  API resource ID
     * @param array|null $params
     * @param array|string|null $options
     * @return Coupon The deleted coupon.
     */
    public static function delete($userId, $id, $params = null, $options = null)
    {
        return self::_userBasedDelete($userId, $id, $params, $options);
    }


}
