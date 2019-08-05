<?php

namespace Pingpp;

class Contact extends AppBase
{
    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return mixed The created contact info.
     */
    public static function create($params = null, $options = null)
    {
        $base = static::appBaseUrl();
        $url = "{$base}/sub_apps/contact";

        return static::_directRequest('post', $url, $params, $options);
    }
}
