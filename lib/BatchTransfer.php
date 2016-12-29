<?php

namespace Pingpp;

class BatchTransfer extends ApiResource
{
    /**
     * This is a special case because the batch transfers endpoint has an
     *    underscore in it. The parent `className` function strips underscores.
     *
     * @return string The name of the class.
     */
    public static function className()
    {
        return 'batch_transfer';
    }

    /**
     * @param string $id The ID of the batchTransfers to retrieve.
     * @param array|string|null $options
     *
     * @return BatchTransfer
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of BatchTransfer.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return BatchTransfer The created batchTransfer.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param $id
     * @param null $options
     * @return BatchTransfer The canceled batchTransfer.
     */
    public static function cancel($id, $options = null)
    {
        $url = static::classUrl().'/'.$id;
        $params = array('status' => 'canceled');
        return static::_directRequest('put', $url, $params, $options);
    }

}
