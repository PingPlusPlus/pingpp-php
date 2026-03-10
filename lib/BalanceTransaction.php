<?php

namespace Pingpp;

class BalanceTransaction extends AppBase
{
    public static function className()
    {
        return 'balance_transaction';
    }

    /**
     * @param string $id The ID of the balance_transaction to retrieve.
     * @param array|string|null $options
     *
     * @return BalanceTransaction
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }


    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of BalanceTransactions.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}
