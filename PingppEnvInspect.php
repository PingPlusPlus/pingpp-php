<?php
/**
 * Class PingppEnvInspect
 * 在使用 Ping++ PHP SDK 前，请执行该文件来检查运行环境是否满足使用 SDK 条件
 * Before using Ping++ PHP SDK, please run this file to ensure the runtime environment is supported
 */

require dirname(__FILE__) . '/init.php';

class PingppEnvInspect
{
    public static function start()
    {
        $apiBaseArr = parse_url(\Pingpp\Pingpp::$apiBase);
        static::$apiHost = $apiBaseArr['host'];
        static::versionCheck();
        foreach (static::$extFunc as $funcName => $msg)
        {
            if (!function_exists($funcName))
            {
                throw new Exception($msg);
            }
        }
        static::domainResolveCheck();
        static::connectionCheck();
        echo "Your PHP system passed the runtime environment inspection successfully.";
    }

    private static $extFunc
        = array(
            "curl_init"          => 'Pingpp needs the CURL PHP extension.',
            "openssl_sign"       => 'Pingpp needs the OpenSSL PHP extension.',
            "json_decode"        => 'Pingpp needs the JSON PHP extension.',
            "mb_detect_encoding" => 'Pingpp needs the Multibyte String PHP extension.',
        );
    private static $minPingppVersion = "5.3";
    private static $apiHost;
    private static $apiKey = 'sk_test_ibbTe5jLGCi5rzfH4OqPW9KC';
    private static $exampleChargeId = 'ch_uT48KOnvf5aDqjfj58XnzzL4';

    private static function versionCheck()
    {
        $phpVersion = phpversion();
        if (version_compare($phpVersion, static::$minPingppVersion, '<'))
        {
            throw new Exception(sprintf('Your server is running PHP version %1$s but Pingpp version requires %2$s at least.', $phpVersion, static::$minPingppVersion));
        }
    }

    private static function domainResolveCheck()
    {
        if (gethostbyname(static::$apiHost) == static::$apiHost)
        {
            throw new Exception(sprintf('Could not resolve %1$s, please check your network or dns settings.', static::$apiHost));
        }
    }

    private static function connectionCheck()
    {
        try {
            \Pingpp\Pingpp::setApiKey(static::$apiKey);
            \Pingpp\Charge::retrieve(static::$exampleChargeId);
        } catch (Exception $e) {
            if ($e instanceof \Pingpp\Error\ApiConnection) {
                throw $e;
            }
        }
    }
}

try {
    PingppEnvInspect::start();
} catch (Exception $e) {
    echo $e->getMessage();
}
