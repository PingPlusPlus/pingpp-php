<?php

namespace Pingpp;

/**
 * 结算账户对象
 * Class SettleAccount
 * @package Pingpp
 */
class SettleAccount extends UserBase
{
    public static function classUrlWithUserId($user_id)
    {
        return User::instanceUrlWithId($user_id) . '/settle_accounts';
    }

    public static function instanceUrlWithSettleAccountId($user_id, $settle_account_id)
    {
        $user_id = Util\Util::utf8($user_id);
        $base = static::classUrlWithUserId($user_id);
        $settle_account_id = urlencode($settle_account_id);
        return $base . '/' . $settle_account_id;
    }

    /**
     * 创建结算账户对象
     * @param $user_id
     * @param $params
     * @param $options
     * @return SettleAccount
     */
    public static function create($user_id, $params, $options = null)
    {
        $url = static::classUrlWithUserId($user_id);
        return static::_directRequest('post', $url, $params, $options);
    }

    /**
     * 查询结算账户对象
     * @param $user_id
     * @param $settle_account_id
     * @param null $params
     * @return SettleAccount
     */
    public static function retrieve($user_id, $settle_account_id, $params = null, $options = null)
    {
        $url = static::instanceUrlWithSettleAccountId($user_id, $settle_account_id);
        return static::_directRequest('get', $url, $params, $options);
    }

    /**
     * 删除结算账户对象
     * @param $user_id
     * @param $settle_account_id
     * @param $params
     * @return SettleAccount
     */
    public static function delete($user_id, $settle_account_id)
    {
        $url = static::instanceUrlWithSettleAccountId($user_id, $settle_account_id);
        return static::_directRequest('delete', $url);
    }

    /**
     * 查询结算账户对象列表
     * @param $user_id
     * @param null $params
     * @return SettleAccount
     */
    public static function all($user_id, $params = null)
    {
        $url = static::classUrlWithUserId($user_id);
        return static::_directRequest('get', $url, $params);
    }
}