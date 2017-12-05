<?php

namespace Pingpp;

class RoyaltyTemplate extends ApiResource
{
    public static function className()
    {
        return 'royalty_template';
    }

    /**
     * @param string $id The ID of the RoyaltyTemplate to retrieve.
     * @param array|string|null $options
     *
     * @return RoyaltyTemplate
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param $params
     * @param null $options
     * @return RoyaltyTemplate
     */
    public static function create($params, $options = null)
    {
        return static::_create($params, $options);
    }

    /**
     * Update RoyaltyTemplate
     * @param $id
     * @param array $params
     * @param array $options
     * @return RoyaltyTemplate
     */
    public static function update($id, $params = [], $options = [])
    {
        $url = static::classUrl() . '/' . $id;
        return static::_directRequest('put', $url, $params, $options);
    }

    /**
     * Delete RoyaltyTemplate
     * @param $id
     * @param array $options
     * @return RoyaltyTemplate
     */
    public static function delete($id, $options = [])
    {
        $url = static::classUrl() . '/' . $id;
        return static::_directRequest('delete', $url, null, $options);
    }

    /**
     * List all RoyaltyTemplate
     * @param $params
     * @param null $options
     * @return RoyaltyTemplate
     */
    public static function all($params = null, $options = null)
    {
        return static::_all($params, $options);
    }
}
