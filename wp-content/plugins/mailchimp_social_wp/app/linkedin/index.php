<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 *                      ** Linkedin **
 * ------------------------------------------------------------------------
 */
require_once("../Configuration.php");

validation_configuration_values();

require_once("../classes/LinkedIn.class.php");

try{
	$li = new LinkedIn(array(
	    'api_key'      => $Configuration['linkedin_api_key'],
	    'api_secret'   => $Configuration['linkedin_api_secret'],
	    'callback_url' => $Configuration['linkedin_callback_url']
	));
	//exit();

	if(isset($_GET['code'])){
		try{
			$token = $li->getAccessToken($_REQUEST['code']);
			$token_expires = $li->getAccessTokenExpiration();
			$response = $li->get('/people/~:(first-name,last-name,email-address,date-of-birth)');
		}catch(Exception $e){
	    	header("Location: ".$responsePage["error"]);
		}
		$transient = Handling::make_transient(@$response["emailAddress"], $first_name=@$response['firstName'], @$response['lastName'], @$birth, @$birth, 'linkedin');
		require_once("../endpoint/index.php");
	}else{
		$url = $li->getLoginUrl(
		  array(
		    LinkedIn::SCOPE_BASIC_PROFILE,
		    LinkedIn::SCOPE_EMAIL_ADDRESS
		  )
		);
		header("Location: ".$url);
		exit();
	}
}catch(Exception $e){
	print_r($e);
	exit();
}
