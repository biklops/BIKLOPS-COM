<?php
/**
 * 			RAFAEL FERREIRA © 2014 || MailChimp Form
 * ------------------------------------------------------------------------
 * 						** Configuration	**
 * ------------------------------------------------------------------------
 */
require( '../../../../../wp-config.php' );

$Configuration = array(#Facebook details
					   "facebook_appid"       => get_option('facebook_appid'),
					   "facebook_appsecret"   => get_option('facebook_appsecret'),
			     "facebook_redirect_url_slug" => get_option('facebook_redirect_url'),
					   #Mailchimp details
					   "Mailchimp_ApiKey" 	  => get_option("Mailchimp_ApiKey"),
					   "Mailchimp_ListID" 	  => get_option("Mailchimp_ListID"),
					   #Google details
					    "google_client_id" 	  => get_option("google_app_client_id"),
					   "google_client_secret" => get_option("google_client_secret"),
					   "google_redirect_uri"  => get_option("google_redirect_uri"),
					  	#MSN/Outlook details
					 "microsoft_client_secret"=> get_option("microsoft_client_secret"),
					   "microsoft_client_id"  => get_option("microsoft_client_id"),
					  "microsoft_response_url"=> get_option("microsoft_response_url"),
					  	#Linkedin
					  "linkedin_api_key"	  => get_option("linkedin_api_key"),
					  "linkedin_api_secret"   => get_option("linkedin_api_secret"),
					  "linkedin_callback_url" => get_option("linkedin_callback_url"),
					  	#VK app
					  "vk_app_id"        => get_option("vk_app_id"),
					  "vk_api_secret"    => get_option("vk_api_secret"),
					  "vk_callback_url"  => get_option("vk_callback_url"),
					  	#disbale collect
					  "disable_flname"			  => get_option("disable_namefields"),
					  "disable_birthday"			  => get_option("disable_birthday"),
);

$activeExtras = array("confirm_form" => !get_option("confirm_form"),
					  "confirm_facebook" => get_option("confirm_facebook"),
					  "confirm_google" => get_option("confirm_google"),
					  "confirm_microsoft" => get_option("confirm_microsoft"),
					  "confirm_linkedin" => get_option("confirm_linkedin"),
					  "confirm_vk" => get_option("confirm_vk"));

$responsePage = array("success"  => get_option("success_redirect_page"),  //response/success.html",
					  "error"    => get_option("error_redirect_page"),    //response/error.html",
					  "repeated" => get_option("repeated_redirect_page"), //response/repeated.html",
					  "bad_email"=> get_option("bad_email_redirect_page") //"response/bad_email.html"//get_option("bad_email_redirect_page")//response/bad_email.html"
);

/**
	FUNCTION TO VALIDATION OF THE CONFIGURATION VALUES
*/
function validation_configuration_values(){
	if(!get_option("Mailchimp_ApiKey") || !get_option("Mailchimp_ListID")){
		exit("Please configure your Mailchimp details!");
	}
	if((get_option("google_app_client_id") && !get_option("google_redirect_uri")) ||
	   (!get_option("google_app_client_id") && get_option("google_client_secret")) ||
	   (!get_option("google_client_secret") && get_option("google_redirect_uri"))){
		exit("Please configure your Google APP details!");
	}
	if(get_option("facebook_appid")  xor get_option("facebook_appsecret")){
		exit("Please configure your Facebook APP details!");
	}
	if((get_option("linkedin_api_key") && !get_option("linkedin_api_secret")) ||
	   (!get_option("linkedin_api_key") && get_option("linkedin_callback_url")) ||
	   (!get_option("linkedin_callback_url") && get_option("linkedin_api_secret"))){
		exit("Please configure your LinkedIn details!");
	}
	if((get_option("microsoft_client_secret") && !get_option("microsoft_response_url")) ||
	   (!get_option("microsoft_client_secret") && get_option("microsoft_client_id")) ||
	   (!get_option("microsoft_client_id") && get_option("microsoft_response_url"))){
		exit("Please configure your Microsoft APP details!");
	}
}

function parse_groupings($list_id){
	if(!get_option("enable_groupings")){
		return NULL;
	}
	$groupings = get_option("groupings".$list_id);
	
	if(!is_array($groupings)){
		return;
	}

	$group = "";
	$i = $j = -1;
	foreach ($groupings as $key => $value) {
		$needle = explode("-", $value);
		if(current($needle)!=$group){
			$array['GROUPINGS'][++$i]['id'] = $group = current($needle);
		}
		$array['GROUPINGS'][$i]['groups'][++$j] = end($needle);
	}
	return $array;
}