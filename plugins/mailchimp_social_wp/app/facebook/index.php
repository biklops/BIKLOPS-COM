<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Facebook **
 * ------------------------------------------------------------------------
 */
require_once("../Configuration.php");

validation_configuration_values();

require_once("../classes/Facebook.class.php");

$response = json_decode(MSW_Facebook::get_email());

if(isset($response->status) && $response->status == "url"){
	if(isset($_GET['skip']) && $_GET['skip'] == 'true'){
		set_transient('skip', 1, 10);
	}
    header("Location: ".$response->data->url);
}else if(isset($response->status) && isset($response->data->profile->email) && $response->status == "success"){
	try{
		if (!isset($response->data->profile->birthday) || strlen($response->data->profile->birthday)==0){
			throw new Exception("Without birthday!");
		}
		$date = new DateTime($response->data->profile->birthday);
		$transient = Handling::make_transient(@$response->data->profile->email, $first_name=@$response->data->profile->first_name, @$response->data->profile->last_name, @date_format($date, "d"), @date_format($date, "m"), 'facebook');
	}catch(Exception $e){
		$transient = Handling::make_transient(@$response->data->profile->email, $first_name=@$response->data->profile->first_name, @$response->data->profile->last_name, @$birth_day, @$birth_month, 'facebook');
	}
	require_once("../endpoint/index.php");
}else{
    header("Location: ".$responsePage["error"]);
}
