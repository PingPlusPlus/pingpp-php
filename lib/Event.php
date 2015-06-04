<?php

namespace Pingpp;

class Event extends ApiResource
{
    /**
     * This is a special case because the red envelope endpoint has an
     *    underscore in it. The parent `className` function strips underscores.
     *
     * @return string The name of the class.
     */
    public static function className()
    {
        return 'event';
    }

    /**
     * @param string $id The ID of the event to retrieve.
     * @param array|string|null $options
     *
     * @return Event
     */
    public static function retrieve($id, $options = null)
    {
        return self::_retrieve($id, $options);
    }

    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return array An array of Events.
     */
    public static function all($params = null, $options = null)
    {
        return self::_all($params, $options);
    }
}
