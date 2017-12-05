<?php

namespace Pingpp;

class BalanceBonus extends AppBase
{
    public static function className()
    {
        return 'balance_bonuse';
    }

    /**
     * @param string $id The ID of the BalanceBonus to retrieve.
     * @param array|string|null $options
     * @return BalanceBonus
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|string|null $options
     * @return BalanceBonus The created BalanceBonus.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param array
     * @return array An array of BalanceBonus.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}