<?php

class Pingpp_List extends Pingpp_Object
{
    public function all($params=null)
    {
        $requestor = new Pingpp_ApiRequestor($this->_apiKey);
        list($response, $apiKey) = $requestor->request(
            'get',
            $this['url'],
            $params
        );
        return Pingpp_Util::convertToPingppObject($response, $apiKey);
    }

    public function create($params=null)
    {
        $requestor = new Pingpp_ApiRequestor($this->_apiKey);
        list($response, $apiKey) = $requestor->request(
            'post', $this['url'], $params
        );
        return Pingpp_Util::convertToPingppObject($response, $apiKey);
    }

    public function retrieve($id, $params=null)
    {
        $requestor = new Pingpp_ApiRequestor($this->_apiKey);
        $base = $this['url'];
        $id = Pingpp_ApiRequestor::utf8($id);
        $extn = urlencode($id);
        list($response, $apiKey) = $requestor->request(
            'get', "$base/$extn", $params
        );
        return Pingpp_Util::convertToPingppObject($response, $apiKey);
    }

}
