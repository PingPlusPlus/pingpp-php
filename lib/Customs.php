<?php

namespace Pingpp;

class Customs extends ApiResource
{
    /**
     * @param string $id The ID of the customs to retrieve.
     * @param array|string|null $options
     *
     * @return Customs
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Customs The created customs.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @return string The API URL for this Pingpp customs.
     */
    public static function classUrl()
    {
        $base = static::className();
        return "/v1/${base}";
    }
}
