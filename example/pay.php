<?php

require_once(dirname(__FILE__) . '../lib/PingPP.php');

$input_data = (array)json_decode(file_get_contents("php://input"));

if(empty($input_data['channel']) || empty($input_data['amount'])) {
    exit();
}

$channel = strtolower($input_data['channel']);
$amount = $input_data['amount'];

$orderNo = substr(md5(time()), 0, 12);

PingPP::setApiKey("YOUR-KEY");
$ch = PingPP_Charge::create(
    array(
        "subject"  => "一心一益",
        "body"     => "一个爱心一份公益",
        "amount"   => $amount,
        "order_no" => $orderNo,
        "channel"  => $channel,
        "client_ip"=> $_SERVER["REMOTE_ADDR"],
        "app" => array("id" => "YOUR-APP-ID")
    )
);


echo $ch;

