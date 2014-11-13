<?php

abstract class Pingpp_Util
{
    /**
     * Whether the provided array (or other) is a list rather than a dictionary.
     *
     * @param array|mixed $array
     * @return boolean True if the given object is a list.
     */
    public static function isList($array)
    {
        if (!is_array($array))
            return false;

        // TODO: generally incorrect, but it's correct given Pingpp's response
        foreach (array_keys($array) as $k) {
            if (!is_numeric($k))
                return false;
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
        $results = array();
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof Pingpp_Object) {
                $results[$k] = $keep_object ? $v->__toStdObject(true) : $v->__toArray(true);
            } else if (is_array($v)) {
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
            if ($v instanceof Pingpp_Object) {
                $results->$k = $v->__toStdObject(true);
            } else if (is_array($v)) {
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
     * @param string $apiKey
     * @return Pingpp_Object|array
     */
    public static function convertToPingppObject($resp, $apiKey)
    {
        $types = array(
            'charge' => 'Pingpp_Charge',
            'list' => 'Pingpp_List',
            'refund' => 'Pingpp_Refund'
        );
        if (self::isList($resp)) {
            $mapped = array();
            foreach ($resp as $i)
                array_push($mapped, self::convertToPingppObject($i, $apiKey));
            return $mapped;
        } else if (is_object($resp)) {
            if (isset($resp->object) 
                && is_string($resp->object)
                && isset($types[$resp->object])) {
                    $class = $types[$resp->object];
                } else {
                    $class = 'Pingpp_Object';
                }
            return Pingpp_Object::scopedConstructFrom($class, $resp, $apiKey);
        } else {
            return $resp;
        }
    }
}
