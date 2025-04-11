<?php
namespace Pingpp;
class FundsTransfer extends AppBase
{
    public static function className()
    {
        return 'funds_transfer';
    }
    /**
     * @param array|null $params
     * @param array|string|null $options
     * @return FundsTransfer The created FundsTransfer.
     */
    public static function create($params, $options = null)
    {
        return static::_create($params, $options);
    }

    /**
     * @param $id string $id The ID of the FundsTransfer to retrieve.
     * @param array|string|null $params
     * @param array|string|null $options
     * @return FundsTransfer
     */
    public static function retrieve($id, $params = null, $options = null)
    {
        return static::_retrieve($id, $options);
    }
}
