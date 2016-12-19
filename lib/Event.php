<?php

namespace Pingpp;

class Event extends ApiResource
{
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
    
}
