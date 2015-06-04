<?php
/**
 * Created by PhpStorm.
 * User: shenlin
 * Date: 15/5/14
 * Time: 17:30
 */

require_once(dirname(__FILE__) . '/../init.php');



\Pingpp\Pingpp::setApiKey('YOUR-KEY');

//$eve = \Pingpp\Event::retrieve('evt_nONfSBowdjKUCCdXz8JRCXLH');
$eves = \Pingpp\Event::all(array("type"=>"charge.succeeded"));
echo $eves;