<?php

namespace Pingpp;

class Agreement extends ApiResource
{
    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Agreement The created agreement.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param string $id The ID of the agreement to retrieve.
     * @param array|string|null $options
     *
     * @return Agreement
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of Agreements.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param string $id  API resource ID
     * @param array|string|null $options
     *
     * @return Agreement The canceled agreement.
     */
    public static function cancel($id, $options = null)
    {
        $url = static::classUrl().'/'.$id;
        $params = ['status' => 'canceled'];
        return static::_directRequest('put', $url, $params, $options);
    }
}
