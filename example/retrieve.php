<?php
/**
 * Created by PhpStorm.
 * User: Lian
 * Date: 14-9-4
 * Time: 下午5:17
 */

//echo $ch->credential;


require_once(dirname(__FILE__) . '../lib/PingPP.php');

PingPP::setApiKey("YOUR-KEY");
$ch = pingpp_Charge::retrieve("ch_id");
