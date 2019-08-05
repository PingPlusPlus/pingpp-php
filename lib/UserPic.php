<?php

namespace Pingpp;

class UserPic extends AppBase
{
    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return mixed The uploaded pic info.
     */
    public static function upload($params = null, $options = null)
    {
        $base = static::appBaseUrl();
        $url = "{$base}/users/upload_pic";

        return static::_directRequest('post', $url, $params, $options);
    }
}
