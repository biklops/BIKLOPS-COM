<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Google **
 * ------------------------------------------------------------------------
 */
require_once("../Configuration.php");

validation_configuration_values();

require_once("../classes/Google.class.php");

$response = json_decode(Google::get_email());

if(isset($response->status) && $response->status == "url"){
    header("Location: ".$response->data->url);
}else if(isset($response->status) && $response->status == "success"){
	try{

		if (!isset($response->data->extra->birthday) || strlen($response->data->extra->birthday)==0){
			throw new Exception("Without birthday!");
		}
		$date = new DateTime($response->data->extra->birthday);
		$transient = Handling::make_transient(@$response->data->profile->email, $first_name=@$response->data->profile->given_name, @$response->data->profile->family_name, @date_format($date, "d"), @date_format($date, "m"), 'google');
	}catch(Exception $e){
		$transient = Handling::make_transient(@$response->data->profile->email, $first_name=@$response->data->profile->given_name, @$response->data->profile->family_name, @$birth, @$birth, 'google');
	}
	require_once("../endpoint/index.php");
}else{
    header("Location: ".$responsePage["error"]);
}
