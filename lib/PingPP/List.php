<?php

class PingPP_List extends PingPP_Object
{
    public function all($params=null)
    {
        $requestor = new PingPP_ApiRequestor($this->_apiKey);
        list($response, $apiKey) = $requestor->request(
            'get',
            $this['url'],
            $params
        );
        return PingPP_Util::convertToPingPPObject($response, $apiKey);
    }

    public function create($params=null)
    {
        $requestor = new PingPP_ApiRequestor($this->_apiKey);
        list($response, $apiKey) = $requestor->request(
            'post', $this['url'], $params
        );
        return PingPP_Util::convertToPingPPObject($response, $apiKey);
    }

    public function retrieve($id, $params=null)
    {
        $requestor = new PingPP_ApiRequestor($this->_apiKey);
        $base = $this['url'];
        $id = PingPP_ApiRequestor::utf8($id);
        $extn = urlencode($id);
        list($response, $apiKey) = $requestor->request(
            'get', "$base/$extn", $params
        );
        return PingPP_Util::convertToPingPPObject($response, $apiKey);
    }

}
