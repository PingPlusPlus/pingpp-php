<?php

namespace Pingpp;

class User extends AppBase
{
    /**
     * @param string $id The ID of the user to retrieve.
     * @param array|string|null $options
     *
     * @return User
     */
    public static function retrieve($id, $options = null)
    {
        $url = static::classUrl().'/'.$id;
        return static::_directRequest('get', $url, null, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of Users.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return User The created user.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param array|string|null $options
     *
     * @return User The saved user.
     */
    public function save($options = null)
    {
        return $this->_save($options);
    }

    public static function update($user_id, $params, $options = null)
    {
        $url = self::instanceUrlWithId($user_id);
        return static::_directRequest('put', $url, $params, $options);
    }
}
