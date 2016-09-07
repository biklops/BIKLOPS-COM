<?php

class GoalWP {
    
    public $apikey;
    public $dc;
    public $root;

    public function __construct($apikey) {
        if(!$apikey){
            throw new Mailchimp_Error('You must provide a MailChimp API key');
        }
        $this->apikey   = $apikey;
        list($key, $dc) = explode("-", $this->apikey, 2);

        if($dc){
            $this->dc = $dc;
        }else{
            $this->dc = 'us1';
        }
        $this->root = 'https://' . $this->dc . '.api.mailchimp.com/3.0/';

        return $this;
    }

    public function get($url = null, $apikey = null) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); 
        curl_setopt($curl, CURLOPT_USERAGENT, 'GoalWP MailChimp PHP 2.0');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: apikey ' . $apikey));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);

        $get = curl_exec($curl);
        $get = json_decode($get);

        if($get->status){
            var_dump($get);
            throw new Exception($get->title . ": " . $get->detail);
        }

        curl_close($curl);

        return $get;
    }
}