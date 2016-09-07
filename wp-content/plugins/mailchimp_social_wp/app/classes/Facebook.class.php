<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Facebook **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class MSW_Facebook{

    public static function get_email() {
        global $Configuration;

        if(isset($_GET['code'])){
            $token = Handling::curlHttpRequest("https://graph.facebook.com/v2.0/oauth/access_token?client_id=".$Configuration['facebook_appid']."&redirect_uri=".$Configuration['facebook_redirect_url_slug']."&client_secret=".$Configuration['facebook_appsecret']."&code=".$_GET['code']);
            $token = explode("&", str_replace("access_token=", "", $token));
            $token = $token[0];
            $request = Handling::curlHttpRequest("https://graph.facebook.com/v2.0/me?fields=email,first_name,last_name,birthday&access_token=".$token);
            return json_encode(array("status" => "success", "data" => array("profile" => json_decode($request))));
        }

        #Auth URL
        $url = "https://www.facebook.com/v2.0/dialog/oauth?client_id=".$Configuration['facebook_appid']."&redirect_uri=".$Configuration['facebook_redirect_url_slug']."&scope=email,user_birthday&response_type=code";
        return json_encode(array("status" => "url", "data" => array("url" => $url)));
    }
}