<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Microsoft **
 * ------------------------------------------------------------------------
 */
require_once("../Configuration.php");

validation_configuration_values();

require_once("../classes/Microsoft.class.php");

if(isset($_GET['code'])){
    $response = Microsoft::getEmail($_GET['code']);
}else{
    $response = Microsoft::getEmail(null);
}

if(isset($response["emails"]) && isset($response["emails"]["preferred"])){
	try{
		$transient = Handling::make_transient(@$response["emails"]["preferred"], $first_name=@$response['first_name'], @$response['last_name'], @$response['birth_day'], @$response['birth_month'], 'microsoft');
	}catch(Exception $e){
		$transient = Handling::make_transient(@$response["emails"]["preferred"], $first_name=@$response['first_name'], @$response['last_name'], @$birth, @$birth, 'microsoft');
	}
	require_once("../endpoint/index.php");
}else{
    header("Location: ".$responsePage["error"]);
}
