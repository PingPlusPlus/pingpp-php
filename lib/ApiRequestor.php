<?php

namespace Pingpp;

class ApiRequestor
{
    /**
     * @var string $apiKey The API key that's to be used to make requests.
     */
    public $apiKey;

    private $_apiBase;

    private $_signOpts;

    public function __construct($apiKey = null, $apiBase = null, $signOpts = null)
    {
        $this->_apiKey = $apiKey;
        if (!$apiBase) {
            $apiBase = Pingpp::$apiBase;
        }
        $this->_apiBase = $apiBase;
        $this->_signOpts = $signOpts;
    }

    private static function _encodeObjects($d, $is_post = false)
    {
        if ($d instanceof ApiResource) {
            return Util\Util::utf8($d->id);
        } else if ($d === true && !$is_post) {
            return 'true';
        } else if ($d === false && !$is_post) {
            return 'false';
        } else if (is_array($d)) {
            $res = array();
            foreach ($d as $k => $v)
                $res[$k] = self::_encodeObjects($v, $is_post);
            return $res;
        } else {
            return Util\Util::utf8($d);
        }
    }

    /**
     * @param array $arr An map of param keys to values.
     * @param string|null $prefix (It doesn't look like we ever use $prefix...)
     *
     * @returns string A querystring, essentially.
     */
    public static function encode($arr, $prefix = null)
    {
        if (!is_array($arr)) {
            return $arr;
        }

        $r = array();
        foreach ($arr as $k => $v) {
            if (is_null($v)) {
                continue;
            }

            if ($prefix && $k && !is_int($k)) {
                $k = $prefix."[".$k."]";
            } else if ($prefix) {
                $k = $prefix."[]";
            }

            if (is_array($v)) {
                $r[] = self::encode($v, $k, true);
            } else {
                $r[] = urlencode($k)."=".urlencode($v);
            }
        }

        return implode("&", $r);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array|null $params
     * @param array|null $headers
     *
     * @return array An array whose first element is the response and second
     *    element is the API key used to make the request.
     */
    public function request($method, $url, $params = null, $headers = null)
    {
        if (!$params) {
            $params = array();
        }
        if (!$headers) {
            $headers = array();
        }
        list($rbody, $rcode, $myApiKey) = $this->_requestRaw($method, $url, $params, $headers);
        $resp = $this->_interpretResponse($rbody, $rcode);
        return array($resp, $myApiKey);
    }


    /**
     * @param string $rbody A JSON string.
     * @param int $rcode
     * @param array $resp
     *
     * @throws InvalidRequestError if the error is caused by the user.
     * @throws AuthenticationError if the error is caused by a lack of
     *    permissions.
     * @throws ApiError otherwise.
     */
    public function handleApiError($rbody, $rcode, $resp)
    {
        if (!is_object($resp) || !isset($resp->error)) {
            $msg = "Invalid response object from API: $rbody "
                ."(HTTP response code was $rcode)";
            throw new Error\Api($msg, $rcode, $rbody, $resp);
        }

        $error = $resp->error;
        $msg = isset($error->message) ? $error->message : null;
        $param = isset($error->param) ? $error->param : null;
        $code = isset($error->code) ? $error->code : null;

        switch ($rcode) {
            case 400:
                if ($code == 'rate_limit') {
                    throw new Error\RateLimit(
                        $msg, $param, $rcode, $rbody, $resp
                    );
                }
            case 404:
                throw new Error\InvalidRequest(
                    $msg, $param, $rcode, $rbody, $resp
                );
            case 401:
                throw new Error\Authentication($msg, $rcode, $rbody, $resp);
            case 402:
                throw new Error\Channel(
                    $msg, $code, $param, $rcode, $rbody, $resp
                );
            default:
                throw new Error\Api($msg, $rcode, $rbody, $resp);
        }
    }

    private function _requestRaw($method, $url, $params, $headers)
    {
        $myApiKey = $this->_apiKey;
        if (!$myApiKey) {
            $myApiKey = Pingpp::$apiKey;
        }

        if (!$myApiKey) {
            $msg = 'No API key provided.  (HINT: set your API key using '
                . '"Pingpp::setApiKey(<API-KEY>)".  You can generate API keys from '
                . 'the Pingpp web interface.  See https://pingxx.com/document/api for '
                . 'details.';
            throw new Error\Authentication($msg);
        }

        $absUrl = $this->_apiBase . $url;
        $params = self::_encodeObjects($params, $method == 'post' || $method == 'put');
        $langVersion = phpversion();
        $uname = php_uname();
        $ua = array(
            'bindings_version' => Pingpp::VERSION,
            'lang' => 'php',
            'lang_version' => $langVersion,
            'publisher' => 'pingplusplus',
            'uname' => $uname
        );
        $defaultHeaders = array(
            'X-Pingpp-Client-User-Agent' => json_encode($ua),
            'User-Agent' => 'Pingpp/v1 PhpBindings/' . Pingpp::VERSION,
            'Authorization' => 'Bearer ' . $myApiKey
        );
        if (Pingpp::$apiVersion) {
            $defaultHeaders['Pingplusplus-Version'] = Pingpp::$apiVersion;
        }
        if ($method == 'post' || $method == 'put') {
            $defaultHeaders['Content-type'] = 'application/json;charset=UTF-8';
        }
        if ($method == 'put') {
            $defaultHeaders['X-HTTP-Method-Override'] = 'PUT';
        }
        $requestHeaders = Util\Util::getRequestHeaders();
        if (isset($requestHeaders['Pingpp-Sdk-Version'])) {
            $defaultHeaders['Pingpp-Sdk-Version'] = $requestHeaders['Pingpp-Sdk-Version'];
        }
        if (isset($requestHeaders['Pingpp-One-Version'])) {
            $defaultHeaders['Pingpp-One-Version'] = $requestHeaders['Pingpp-One-Version'];
        }

        $combinedHeaders = array_merge($defaultHeaders, $headers);

        $rawHeaders = array();

        foreach ($combinedHeaders as $header => $value) {
            $rawHeaders[] = $header . ': ' . $value;
        }

        list($rbody, $rcode) = $this->_curlRequest(
            $method,
            $absUrl,
            $rawHeaders,
            $params
        );
        return array($rbody, $rcode, $myApiKey);
    }

    private function _interpretResponse($rbody, $rcode)
    {
        try {
            $resp = json_decode($rbody);
        } catch (Exception $e) {
            $msg = "Invalid response body from API: $rbody "
                . "(HTTP response code was $rcode)";
            throw new Error\Api($msg, $rcode, $rbody);
        }

        if ($rcode < 200 || $rcode >= 300) {
            $this->handleApiError($rbody, $rcode, $resp);
        }
        return $resp;
    }

    private function _curlRequest($method, $absUrl, $headers, $params)
    {
        $curl = curl_init();
        $method = strtolower($method);
        $opts = array();
        $dataToBeSign = '';
        $requestTime = null;
        if ($method === 'get' || $method === 'delete') {
            if ($method === 'get') {
                $opts[CURLOPT_HTTPGET] = 1;
            } else {
                $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
            }
            $dataToBeSign .= parse_url($absUrl, PHP_URL_PATH);
            if (count($params) > 0) {
                $encoded = self::encode($params);
                $absUrl = "$absUrl?$encoded";
                $dataToBeSign .= '?' . $encoded;
            }
            $requestTime = time();
        } elseif ($method === 'post' || $method === 'put') {
            if ($method === 'post') {
                $opts[CURLOPT_POST] = 1;
            } else {
                $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
            }
            $rawRequestBody = $params !== null ? json_encode($params) : '';
            $opts[CURLOPT_POSTFIELDS] = $rawRequestBody;
            $dataToBeSign .= $rawRequestBody;
            if ($this->_signOpts !== null) {
                if (isset($this->_signOpts['uri']) && $this->_signOpts['uri']) {
                    $dataToBeSign .= parse_url($absUrl, PHP_URL_PATH);
                }
                if (isset($this->_signOpts['time']) && $this->_signOpts['time']) {
                    $requestTime = time();
                }
            }
        } else {
            throw new Error\Api("Unrecognized method $method");
        }

        if ($this->privateKey()) {
            if ($requestTime !== null) {
                $dataToBeSign .= $requestTime;
                $headers[] = 'Pingplusplus-Request-Timestamp: ' . $requestTime;
            }
            $signResult = openssl_sign($dataToBeSign, $requestSignature, $this->privateKey(), 'sha256');
            if (!$signResult) {
                throw new Error\Api("Generate signature failed");
            }
            $headers[] = 'Pingplusplus-Signature: ' . base64_encode($requestSignature);
        }

        $absUrl = Util\Util::utf8($absUrl);
        $opts[CURLOPT_URL] = $absUrl;
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_CONNECTTIMEOUT] = 30;
        $opts[CURLOPT_TIMEOUT] = 80;
        $opts[CURLOPT_HTTPHEADER] = $headers;
        if (!Pingpp::$verifySslCerts) {
            $opts[CURLOPT_SSL_VERIFYPEER] = false;
        }

        curl_setopt_array($curl, $opts);
        $rbody = curl_exec($curl);

        if (!defined('CURLE_SSL_CACERT_BADFILE')) {
            define('CURLE_SSL_CACERT_BADFILE', 77);  // constant not defined in PHP
        }

        $errno = curl_errno($curl);
        if ($errno == CURLE_SSL_CACERT ||
            $errno == CURLE_SSL_PEER_CERTIFICATE ||
            $errno == CURLE_SSL_CACERT_BADFILE) {
                array_push(
                    $headers,
                    'X-Pingpp-Client-Info: {"ca":"using Pingpp-supplied CA bundle"}'
                );
                $cert = $this->caBundle();
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_CAINFO, $cert);
                $rbody = curl_exec($curl);
            }

        if ($rbody === false) {
            $errno = curl_errno($curl);
            $message = curl_error($curl);
            curl_close($curl);
            $this->handleCurlError($errno, $message);
        }

        $rcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return array($rbody, $rcode);
    }

    /**
     * @param number $errno
     * @param string $message
     * @throws ApiConnectionError
     */
    public function handleCurlError($errno, $message)
    {
        $apiBase = Pingpp::$apiBase;
        switch ($errno) {
        case CURLE_COULDNT_CONNECT:
        case CURLE_COULDNT_RESOLVE_HOST:
        case CURLE_OPERATION_TIMEOUTED:
            $msg = "Could not connect to Ping++ ($apiBase).  Please check your "
                . "internet connection and try again.  If this problem persists, "
                . "you should check Pingpp's service status at "
                . "https://pingxx.com/status.";
            break;
        case CURLE_SSL_CACERT:
        case CURLE_SSL_PEER_CERTIFICATE:
            $msg = "Could not verify Ping++'s SSL certificate.  Please make sure "
                . "that your network is not intercepting certificates.  "
                . "(Try going to $apiBase in your browser.)";
            break;
        default:
            $msg = "Unexpected error communicating with Ping++.";
        }

        $msg .= "\n\n(Network error [errno $errno]: $message)";
        throw new Error\ApiConnection($msg);
    }

    private function caBundle()
    {
        return dirname(__FILE__) . '/../data/ca-certificates.crt';
    }

    private function privateKey()
    {
        if (!Pingpp::$privateKey) {
            if (!Pingpp::$privateKeyPath) {
                return NULL;
            }
            if (!file_exists(Pingpp::$privateKeyPath)) {
                throw new Error\Api('Private key file not found at: ' . Pingpp::$privateKeyPath);
            }
            Pingpp::$privateKey = file_get_contents(Pingpp::$privateKeyPath);
        }
        return Pingpp::$privateKey;
    }
}
