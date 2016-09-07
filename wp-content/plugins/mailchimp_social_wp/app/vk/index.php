<?php
require_once('../classes/VK/VK.php');
require_once('../classes/VK/VKException.php');
require_once("../Configuration.php");
require_once("../classes/Handling.class.php");

validation_configuration_values();

$vk_config = array(
    'app_id'        => $Configuration["vk_app_id"],
    'api_secret'    => $Configuration["vk_api_secret"],
    'callback_url'  => $Configuration["vk_callback_url"],
    'api_settings'  => 'email'

);

try {
    $vk = new VK\VK($vk_config['app_id'], $vk_config['api_secret']);

    if (!isset($_REQUEST['code'])) {
        $authorize_url = $vk->getAuthorizeURL(
            $vk_config['api_settings'], $vk_config['callback_url']);
        header("Location: ".$authorize_url);
    } else {
        $access_token = $vk->getAccessToken($_REQUEST['code'], $vk_config['callback_url']);

        $info = $vk->api('users.get', array(
            'uid'       => $access_token['user_id'],
            'fields'    => 'first_name,last_name,bdate',
        ));

        try{
            if(!isset(current($info["response"])['bdate'])){
                throw new Exception("Error Processing Request", 1);
            }
            $date = new DateTime(str_replace(".","-", current($info["response"])['bdate']));
            $transient = Handling::make_transient(@$access_token["email"], @current($info["response"])['first_name'], @current($info["response"])['last_name'], @date_format($date, "d"), @date_format($date, "m"), 'vk');
        }catch(Exception $e){
            $transient = Handling::make_transient(@$access_token["email"], $first_name=@current($info["response"])['first_name'], @current($info["response"])['last_name'], NULL, NULL, 'vk');
        }
        require_once("../endpoint/index.php");
    }
} catch (VK\VKException $error) {
    echo $error->getMessage();
}
