<?php

namespace Pingpp;

class ProfitTransaction extends ApiResource
{
    public static function className()
    {
        return 'profit_transaction';
    }
    /**
     * @param string $id The ID of the profit_transaction to retrieve.
     * @param array|string|null $options
     *
     * @return ProfitTransaction
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of ProfitTransactions.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}
