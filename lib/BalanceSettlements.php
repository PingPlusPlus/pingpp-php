<?php

namespace Pingpp;

class BalanceSettlements extends AppBase
{
    public static function className()
    {
        return 'balance_settlement';
    }

    /**
     * @param string $id The ID of the BalanceSettlements to retrieve.
     * @param array|string|null $options
     * @return BalanceSettlements
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array
     * @return array An array of BalanceSettlements.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}