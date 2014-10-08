<?php
/**
 * Created by PhpStorm.
 * User: Lian
 * Date: 14-9-4
 * Time: 下午5:16
 */

require_once(dirname(__FILE__) . '../lib/PingPP.php');

PingPP::setApiKey("YOUR-KEY");
$ch = PingPP_Charge::retrieve("ch_id");
$ch->refund(
    array(
        "amount" => 10,
        "description" => "apple"
    )
);
