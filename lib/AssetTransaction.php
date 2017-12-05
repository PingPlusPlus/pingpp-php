<?php

namespace Pingpp;

class AssetTransaction extends AppBase
{
    /**
     * This is a special case because the card info endpoint has an
     *    underscore in it. The parent `className` function strips underscores.
     *
     * @return string The name of the class.
     */
    public static function className()
    {
        return 'asset_transaction';
    }

    /**
     * @param string $id The ID of the asset_transaction to retrieve.
     * @param array|string|null $options
     *
     * @return AssetTransaction
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of AssetTransactions.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}
