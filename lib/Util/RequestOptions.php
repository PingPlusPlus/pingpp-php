<?php

namespace Pingpp\Util;

use Pingpp\Error;

class RequestOptions
{
    public $headers;
    public $apiKey;
    public $signOpts;

    public function __construct($key = null, $headers = array(), $signOpts = array())
    {
        $this->apiKey = $key;
        $this->headers = $headers;
        $this->signOpts = $signOpts;
    }

    /**
     * Unpacks an options array and merges it into the existing RequestOptions
     * object.
     * @param array|string|null $options a key => value array
     *
     * @return RequestOptions
     */
    public function merge($options)
    {
        $other_options = self::parse($options);
        if ($other_options->apiKey === null) {
            $other_options->apiKey = $this->apiKey;
        }
        $other_options->headers = array_merge($this->headers, $other_options->headers);
        return $other_options;
    }

    /**
     * Unpacks an options array into an RequestOptions object
     * @param array|string|null $options a key => value array
     *
     * @return RequestOptions
     */
    public static function parse($options)
    {
        if ($options instanceof self) {
            return $options;
        }

        if (is_null($options)) {
            return new RequestOptions(null, array());
        }

        if (is_string($options)) {
            return new RequestOptions($options, array());
        }

        if (is_array($options)) {
            $headers = array();
            $key = null;
            $signOpts = array();
            if (array_key_exists('api_key', $options)) {
                $key = $options['api_key'];
            }
            if (array_key_exists('pingpp_version', $options)) {
                $headers['Pingpp-Version'] = $options['pingpp_version'];
            }
            if (array_key_exists('sign_opts', $options)) {
                $signOpts = $options['sign_opts'];
            }
            return new RequestOptions($key, $headers, $signOpts);
        }

        $message = 'The second argument to Pingpp API method calls is an '
           . 'optional per-request apiKey, which must be a string, or '
           . 'per-request options, which must be an array. (HINT: you can set '
           . 'a global apiKey by "Pingpp::setApiKey(<apiKey>)")';
        throw new Error\Api($message);
    }

    /**
     * @param array $opts The custom options
     * @param array $signOpts The sign options
     * @return array The merged options
     */
    public static function parseWithSignOpts($opts, $signOpts)
    {
        $options = self::parse($opts);
        $options->signOpts = array_merge($options->signOpts, $signOpts);
        return $options;
    }

    /**
     * @param array $signOpts The sign options
     * @return array The merged options
     */
    public function mergeSignOpts($signOpts)
    {
        $this->signOpts = array_merge($this->signOpts, $signOpts);
        return $this;
    }
}
