<?php
if(!defined('WP_UNINSTALL_PLUGIN'))
	exit();

require_once("mailchimp_social_wp.php");

$ctx = stream_context_create(array('http' => array('timeout' => 50)));
$version = @json_decode(@file_get_contents("http://codecanyon.rafaelferreira.pt/registry/count/newest_version.json", 0, $ctx));

if(!isset($version->version) || Mailchimp_Social_WP::version()==$version->version){
	$option = array('success_redirect_page', 'error_redirect_page', 'repeated_redirect_page',
		'bad_email_redirect_page', 'facebook_appid', 'facebook_appsecret', 'Mailchimp_ApiKey',
		'Mailchimp_ListID', 'google_app_client_id', 'google_client_secret', 'google_redirect_uri', 'microsoft_client_secret',
		'microsoft_client_id', 'microsoft_response_url', 'facebooktrigger', 'googletrigger',
		'microsofttrigger', 'emailtrigger', 'enable_languages', 'iframe_width',
		'iframe_height', "iframe_button_color", "iframe_extra_text_color", "embed_iframe", "extra_text_embed",
		"txt-title", "txt-facebook_label", "groupings", "enable_groupings", "enable_namefields",
	    "txt-google_label", "txt-outlook_label",
	    "txt-email_label", "txt-subscribe_label","txt-title_response", "txt-its_free",
	    "txt-email_wrong", "txt-someting_went_wrong",
	    "txt-already_subscribed", "txt-thank_you", 'popovers-facebooktrigger', 'popovers-googletrigger', 'popovers-microsofttrigger',
	    'popovers-emailtrigger', 'popovers-iframe_width', 'popovers-iframe_height', 'popovers-extra_text_embed',
	    'popovers-iframe_extra_text_color',
	    'popovers-iframe_button_color',
	    "txt-greeting");

	foreach ($option as $key) {
		delete_option($key);
	}
}
