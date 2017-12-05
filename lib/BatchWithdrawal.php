<?php

namespace Pingpp;

class BatchWithdrawal extends AppBase
{
    public static function className()
    {
        return 'batch_withdrawal';
    }

    /**
     * @param string $id The ID of the batch withdrawal to retrieve.
     * @param array|string|null $options
     *
     * @return BatchWithdrawal
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * 批量提现确认
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return BatchWithdrawal The created withdrawal.
     */
    public static function confirm($params = null, $options = null)
    {
        $params['status'] = 'pending';
        return self::_create($params, $options);
    }

    /**
     * 批量提现撤销
     * @param null $params
     * @param null $options
     * @return array|PingppObject
     */
    public static function cancel($params = null, $options = null)
    {
        $params['status'] = 'canceled';
        return self::_create($params, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     * @param $options
     * @return array An array of BatchWithdrawal.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }


}
