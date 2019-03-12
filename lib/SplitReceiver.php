<?php

namespace Pingpp;

class SplitReceiver extends ApiResource
{
    public static function className()
    {
        return 'split_receiver';
    }
    /**
     * @param string $id The ID of the split_receiver to retrieve.
     * @param array|string|null $options
     *
     * @return SplitReceiver
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of SplitReceivers.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return SplitReceiver The created split_receiver.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param $id
     * @param null $params
     * @param null $options
     * @return $this
     */
    public static function delete($id, $params = null, $options = null)
    {
        $url = static::classUrl() . '/' . $id;
        return static::_directRequest('delete', $url, $options);
    }
}
