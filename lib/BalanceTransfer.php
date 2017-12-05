<?php

namespace Pingpp;

class BalanceTransfer extends AppBase
{
    public static function className()
    {
        return 'balance_transfer';
    }

    /**
     * @param string $id The ID of the coupon to retrieve.
     * @param array|string|null $options
     * @return BalanceTransfer
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|string|null $options
     * @return BalanceTransfer The created BalanceTransfer.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param string $userId
     * @return array An array of BalanceTransfer.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}