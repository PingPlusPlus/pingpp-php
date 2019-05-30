<?php

namespace Pingpp\Util;

use Pingpp\PingppObject;
use stdClass;

abstract class Util
{
    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     *
     * @param array|mixed $array
     * @return boolean True if the given object is a list.
     */
    public static function isList($array)
    {
        if (!is_array($array)) {
            return false;
        }

        // TODO: generally incorrect, but it's correct given Pingpp's response
        foreach (array_keys($array) as $k) {
            if (!is_numeric($k)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Recursively converts the PHP Pingpp object to an array.
     *
     * @param array $values The PHP Pingpp object to convert.
     * @param bool
     * @return array
     */
    public static function convertPingppObjectToArray($values, $keep_object = false)
    {
        $results = [];
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof PingppObject) {
                $results[$k] = $keep_object ? $v->__toStdObject(true) : $v->__toArray(true);
            } elseif (is_array($v)) {
                $results[$k] = self::convertPingppObjectToArray($v, $keep_object);
            } else {
                $results[$k] = $v;
            }
        }
        return $results;
    }

    /**
     * Recursively converts the PHP Pingpp object to an stdObject.
     *
     * @param array $values The PHP Pingpp object to convert.
     * @return array
     */
    public static function convertPingppObjectToStdObject($values)
    {
        $results = new stdClass;
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof PingppObject) {
                $results->$k = $v->__toStdObject(true);
            } elseif (is_array($v)) {
                $results->$k = self::convertPingppObjectToArray($v, true);
            } else {
                $results->$k = $v;
            }
        }
        return $results;
    }

    /**
     * Converts a response from the Pingpp API to the corresponding PHP object.
     *
     * @param stdObject $resp The response from the Pingpp API.
     * @param array $opts
     * @return PingppObject|array
     */
    public static function convertToPingppObject($resp, $opts)
    {
        $types = [
            'agreement' => \Pingpp\Agreement::class,
            'balance_bonus' => \Pingpp\BalanceBonus::class,
            'balance_settlement' => \Pingpp\BalanceSettlements::class,
            'balance_transaction' => \Pingpp\BalanceTransaction::class,
            'balance_transfer' => \Pingpp\BalanceTransfer::class,
            'batch_refund' => \Pingpp\BatchRefund::class,
            'batch_transfer' => \Pingpp\BatchTransfer::class,
            'batch_withdrawal' => \Pingpp\BatchWithdrawal::class,
            'channel' => \Pingpp\Channel::class,
            'charge' => \Pingpp\Charge::class,
            'coupon' => \Pingpp\Coupon::class,
            'coupon_template' => \Pingpp\CouponTemplate::class,
            'customs' => \Pingpp\Customs::class,
            'event' => \Pingpp\Event::class,
            'list' => \Pingpp\Collection::class,
            'order' => \Pingpp\Order::class,
            'profit_transaction' => \Pingpp\ProfitTransaction::class,
            'recharge' => \Pingpp\Recharge::class,
            'red_envelope' => \Pingpp\RedEnvelope::class,
            'refund' => \Pingpp\Refund::class,
            'royalty' => \Pingpp\Royalty::class,
            'royalty_settlement' => \Pingpp\RoyaltySettlement::class,
            'royalty_template' => \Pingpp\RoyaltyTemplate::class,
            'royalty_transaction' => \Pingpp\RoyaltyTransaction::class,
            'settle_account' => \Pingpp\SettleAccount::class,
            'split_profit' => \Pingpp\SplitProfit::class,
            'split_receiver' => \Pingpp\SplitReceiver::class,
            'sub_app' => \Pingpp\SubApp::class,
            'sub_bank' => \Pingpp\SubBank::class,
            'transfer' => \Pingpp\Transfer::class,
            'user' => \Pingpp\User::class,
            'withdrawal' => \Pingpp\Withdrawal::class,
        ];
        if (self::isList($resp)) {
            $mapped = [];
            foreach ($resp as $i) {
                array_push($mapped, self::convertToPingppObject($i, $opts));
            }
            return $mapped;
        } elseif (is_object($resp)) {
            if (isset($resp->object)
                && is_string($resp->object)
                && isset($types[$resp->object])) {
                    $class = $types[$resp->object];
            } else {
                $class = 'Pingpp\\PingppObject';
            }
            return $class::constructFrom($resp, $opts);
        } else {
            return $resp;
        }
    }

    /**
     * Get the request headers
     * @return array An hash map of request headers.
     */
    public static function getRequestHeaders()
    {
        if (function_exists('getallheaders')) {
            $headers = [];
            foreach (getallheaders() as $name => $value) {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('-', ' ', $name))))] = $value;
            }
            return $headers;
        }
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    /**
     * @param string|mixed $value A string to UTF8-encode.
     *
     * @return string|mixed The UTF8-encoded string, or the object passed in if
     *    it wasn't a string.
     */
    public static function utf8($value)
    {
        if (is_string($value)
            && mb_detect_encoding($value, "UTF-8", true) != "UTF-8"
        ) {
            return utf8_encode($value);
        } else {
            return $value;
        }
    }
}
