<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Microsoft    **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Microsoft{

	public static function getEmail($code=null){
		global $Configuration;
		$url = "https://login.live.com/oauth20_authorize.srf?client_id=".$Configuration["microsoft_client_id"]."&scope=wl.emails,wl.birthday&response_type=code&redirect_uri=".$Configuration["microsoft_response_url"];

		if(is_null($code)){
			header("Location: ".$url);
			exit();
		}else{
			$data = json_decode(Handling::curlHttpRequest("https://login.live.com/oauth20_token.srf", "post", "code=" . $code . "&client_id=" .$Configuration["microsoft_client_id"] . "&client_secret=" .$Configuration["microsoft_client_secret"] . "&redirect_uri=".$Configuration["microsoft_response_url"]."&grant_type=authorization_code"));

			if(!isset($data->access_token)){
				header("Location: ".$url);
				exit();
			}

			return json_decode(Handling::curlHttpRequest("https://apis.live.net/v5.0/me?access_token=" . $data->access_token), true);
		}
	}
}