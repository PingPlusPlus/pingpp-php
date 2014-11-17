<?php

class Pingpp_Charge extends Pingpp_ApiResource
{
    /**
     * @param string $id The ID of the charge to retrieve.
     * @param string|null $apiKey
     *
     * @return Pingpp_Charge
     */
    public static function retrieve($id, $apiKey=null)
    {
        $class = get_class();
        return self::_scopedRetrieve($class, $id, $apiKey);
    }

    /**
     * @param array|null $params
     * @param string|null $apiKey
     *
     * @return array An array of Pingpp_Charges.
     */
    public static function all($params=null, $apiKey=null)
    {
        $class = get_class();
        return self::_scopedAll($class, $params, $apiKey);
    }

    /**
     * @param array|null $params
     * @param string|null $apiKey
     *
     * @return Pingpp_Charge The created charge.
     */
    public static function create($params=null, $apiKey=null)
    {
        $class = get_class();
        return self::_scopedCreate($class, $params, $apiKey);
    }

    /**
     * @return Pingpp_Charge The saved charge.
     */
    public function save()
    {
        $class = get_class();
        return self::_scopedSave($class);
    }

    /**
     * @return The json encoded credential.
     */
    public function getCredential()
    {
        $c = array();
        if (! isset($this->channel)) {
            throw new Exception('Channel is unset');
        } else if($this->channel == Channel::ALIPAY) {
            if (isset($this->credential['alipay'])) {
                $c['alipay']['orderInfo'] = $this->credential['alipay']['orderInfo'];
            }
        } else if($this->channel == Channel::WECHAT) {
            if (isset($this->credential['wx'])) {
                $c['wx']['appId'] = $this->credential['wx']['appId'];
                $c['wx']['partnerId'] = $this->credential['wx']['partnerId'];
                $c['wx']['prepayId'] = $this->credential['wx']['prepayId'];
                $c['wx']['nonceStr'] = $this->credential['wx']['nonceStr'];
                $c['wx']['timeStamp'] = $this->credential['wx']['timeStamp'];
                $c['wx']['packageValue'] = $this->credential['wx']['packageValue'];
                $c['wx']['sign'] = $this->credential['wx']['sign'];
            }
        } else if($this->channel == Channel::UPMP) {
            if (isset($this->credential['upmp'])) {
                $c['upmp']['tn'] = $this->credential['upmp']['tn'];
                $c['upmp']['mode'] = $this->credential['upmp']['mode'];
            }
        } else {
            throw new Exception('Channel is unknown: '.$this->channel);
        }
        if (defined('JSON_PRETTY_PRINT'))
            return json_encode($c, JSON_FORCE_OBJECT|JSON_PRETTY_PRINT);
        else
            return json_encode($c, JSON_FORCE_OBJECT);
    }
}
