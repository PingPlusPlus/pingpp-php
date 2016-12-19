<?php

namespace Pingpp;

class Identification extends ApiResource
{
    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Identification result.
     */
    public static function identify($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @return string The API URL for this Pingpp identification.
     */
     public static function classUrl()
     {
         $base = static::className();
         return "/v1/${base}";
     }
}
