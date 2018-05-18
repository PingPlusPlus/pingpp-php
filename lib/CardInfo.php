<?php

namespace Pingpp;

class CardInfo extends ApiResource
{
    public static function className()
    {
        return 'card_info';
    }

    /**
     * @return string The API URL for this Pingpp CardInfo.
     */
    public static function classUrl()
    {
        $base = static::className();
        return "/v1/${base}";
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return CardInfo result.
     */
    public static function query($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

}
