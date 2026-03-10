<?php

namespace Pingpp;

class SplitProfit extends ApiResource
{
    public static function className()
    {
        return 'split_profit';
    }
    /**
     * @param string $id The ID of the split_profit to retrieve.
     * @param array|string|null $options
     *
     * @return SplitProfit
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of SplitProfits.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return SplitProfit The created split_profit.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }
}
