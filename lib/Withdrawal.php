<?php

namespace Pingpp;

class Withdrawal extends AppBase
{
    /**
     * @param string $id The ID of the withdrawal to retrieve.
     * @param array|string|null $options
     *
     * @return Withdrawal
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return Withdrawal The created withdrawal.
     */
    public static function create($params = null, $options = null)
    {
        return self::_create($params, $options);
    }

    /**
     * @param string $id  API resource ID
     * @param array|string|null $options
     *
     * @return Withdrawal The confirmed withdrawal.
     */
    public static function confirm($id, $options = null)
    {
        $url = static::classUrl().'/'.$id;
        $params = array('status' => 'pending');
        return static::_directRequest('put', $url, $params, $options);
    }

    /**
     * @param string $id  API resource ID
     * @param array|string|null $options
     *
     * @return Withdrawal The canceled withdrawal.
     */
    public static function cancel($id, $options = null)
    {
        $url = static::classUrl().'/'.$id;
        $params = array('status' => 'canceled');
        return static::_directRequest('put', $url, $params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of Withdrawal.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of batch withdrawals.
     */
    public static function batchConfirm($params = null, $options = null)
    {
        $url = static::appBaseUrl().'/batch_withdrawals';
        return static::_directRequest('post', $url, $params, $options);
    }
}
