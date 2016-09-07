<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Google **
 * ------------------------------------------------------------------------
 */
require_once("Handling.class.php");

class Google{
    public static function get_email() {
        global $Configuration;

        if (isset($_GET['code'])) {
            $token = json_decode(Handling::curlHttpRequest("https://accounts.google.com/o/oauth2/token", "post", array(
                    "code" => $_GET['code'],
                    "client_id" => $Configuration["google_client_id"],
                    "client_secret" => $Configuration["google_client_secret"],
                    "redirect_uri"  => $Configuration["google_redirect_uri"],
                    "grant_type" => "authorization_code")));

            if(isset($token->id_token)){
                $request[0] = Handling::curlHttpRequest("https://www.googleapis.com/oauth2/v1/userinfo??alt=json&access_token=".$token->access_token);
                $request[1] = Handling::curlHttpRequest("https://www.googleapis.com/plus/v1/people/me?key=".$Configuration["google_client_id"]."&access_token=".$token->access_token);
                return json_encode(array("status" => "success", "data" => array("profile" => json_decode($request[0]), "extra" => json_decode($request[1]))));
            }
        }

        #Auth URL
        $scopes = urlencode('https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/plus.login');
        $url = "https://accounts.google.com/o/oauth2/auth?client_id=".$Configuration["google_client_id"]."&response_type=code&scope=".$scopes."&redirect_uri=".$Configuration["google_redirect_uri"]."&access_type=online&approval_prompt=auto";
        return json_encode(array("status" => "url", "data" => array("url" => $url)));
    }
}