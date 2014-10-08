<?php

abstract class PingPP_Util
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

        // TODO: generally incorrect, but it's correct given PingPP's response
        foreach (array_keys($array) as $k) {
            if (!is_numeric($k))
                return false;
        }
        return true;
    }

    /**
     * Recursively converts the PHP PingPP object to an array.
     *
     * @param array $values The PHP PingPP object to convert.
     * @return array
     */
    public static function convertPingPPObjectToArray($values)
    {
        $results = array();
        foreach ($values as $k => $v) {
            // FIXME: this is an encapsulation violation
            if ($k[0] == '_') {
                continue;
            }
            if ($v instanceof PingPP_Object) {
                $results[$k] = $v->__toArray(true);
            } else if (is_array($v)) {
                $results[$k] = self::convertPingPPObjectToArray($v);
            } else {
                $results[$k] = $v;
            }
        }
        return $results;
    }

    /**
     * Converts a response from the PingPP API to the corresponding PHP object.
     *
     * @param array $resp The response from the PingPP API.
     * @param string $apiKey
     * @return PingPP_Object|array
     */
    public static function convertToPingPPObject($resp, $apiKey)
    {
        $types = array(
            'charge' => 'PingPP_Charge',
            'list' => 'PingPP_List'
        );
        if (self::isList($resp)) {
            $mapped = array();
            foreach ($resp as $i)
                array_push($mapped, self::convertToPingPPObject($i, $apiKey));
            return $mapped;
        } else if (is_array($resp)) {
            if (isset($resp['object']) 
                && is_string($resp['object'])
                && isset($types[$resp['object']])) {
                    $class = $types[$resp['object']];
                } else {
                    $class = 'PingPP_Object';
                }
            return PingPP_Object::scopedConstructFrom($class, $resp, $apiKey);
        } else {
            return $resp;
        }
    }
}
