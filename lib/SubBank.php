<?php

namespace Pingpp;

class SubBank extends ApiResource
{
    public static function className()
    {
        return 'sub_bank';
    }

    /**
     * @param array $params
     * @param array|string|null $options
     *
     * @return Collection result.
     */
    public static function query($params, $options = null)
    {
        return self::_all($params, $options);
    }
}
