<?php

namespace Pingpp;

class BatchRefund extends ApiResource
{
    /**
     * This is a special case because the batch refunds endpoint has an
     *    underscore in it. The parent `className` function strips underscores.
     *
     * @return string The name of the class.
     */
    public static function className()
    {
        return 'batch_refund';
    }

    /**
     * @param string $id The ID of the batchRefunds to retrieve.
     * @param array|string|null $options
     *
     * @return BatchRefund
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of BatchRefund.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return BatchRefund The created batchRefund.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

}
