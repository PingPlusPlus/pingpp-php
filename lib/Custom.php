<?php

namespace Pingpp;

class Custom extends ApiResource
{
    /**
     * @param string $id The ID of the customs to retrieve.
     * @param array|string|null $options
     *
     * @return Custom
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Custom The created customs.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }
}
