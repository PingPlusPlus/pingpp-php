<?php
/**
 * Created by PhpStorm.
 * User: Lian
 * Date: 14-9-4
 * Time: 下午6:37
 */


$input_data = (array)json_decode(file_get_contents("php://input"));
if($input_data['object'] == 'charge')
{
    //TODO update database
    echo 'success';
}
else if($input_data['object'] == 'refund')
{
    //TODO update database
    echo 'success';
}
else
{
    echo 'fail';
}

?>