<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Handling Tools **
 * ------------------------------------------------------------------------
 */
require_once("Model_MailChimp.class.php");

class Handling{

	public static function handling_request($email, $profile, $lists, $service){
		global $activeExtras;
		$ok = True;
		foreach ($lists as $key => $value) {
			if(isset($activeExtras["confirm_".$service]) && $activeExtras["confirm_".$service]){
				$tmp = self::handling_request_with_confirmation($email, $profile, $value, $response, $error);
				if(!$tmp){
					$response_final = $response;
					$error_final = $error;
				}
				$ok = $ok && $tmp;
			}else{
				$tmp = self::handling_request_without_confirmation($email, $profile, $value, $response, $error);
				if(!$tmp){
					$response_final = $response;
					$error_final = $error;
				}
				$ok = $ok && $tmp;
			}
		}
		if($ok){
			self::handling_this(NULL, NULL, $service);
		}else{
			self::handling_this($response_final, $error_final);
		}
	}

	public static function handling_request_without_confirmation($email, $profile, $list, &$response, &$error){
		try{
			Model_MailChimp::subscribe($email, $profile, $list);
		}catch(MSW_Mailchimp_List_AlreadySubscribed $e){
			$response = "List_AlreadySubscribed";
			return False;
		}catch(MSW_Mailchimp_List_MergeFieldRequired $e){
			$response = "Please go to http://mailchimp.com/, login, go to your list, then Settings, and put \"First Name\" and \"Last Name\" not required.";
			return False;
		}catch(MSW_Mailchimp_Invalid_ApiKey $e){
			$response = "Your API Key is Invalid!";
			return False;
		}catch(MSW_Mailchimp_List_DoesNotExist $e){
			$response = "The list that you provided does not exists!";
			return False;
		}catch(Exception $e){
			Mailchimp_Social_WP::sendError(print_r($e, true), "Handling.class.php", "24");
			$error = $e->getMessage();
			$response = "ERRO"; 
			return False;
		}
		return True;
	}

	public static function handling_request_with_confirmation($email, $profile, $list, &$response, &$error){
		try{
			Model_MailChimp::subscribe_with_confirmation($email, $profile, $list);
		}catch(MSW_Mailchimp_List_AlreadySubscribed $e){
			$response = "List_AlreadySubscribed";
			return False;
		}catch(MSW_Mailchimp_List_MergeFieldRequired $e){
			$response = "Please go to http://mailchimp.com/, login, go to your list, then Settings, and put \"First Name\" and \"Last Name\" not required.";
			return False;
		}catch(MMSW_ailchimp_Invalid_ApiKey $e){
			$response = "Your API Key is Invalid!";
			return False;
		}catch(MSW_Mailchimp_List_DoesNotExist $e){
			$response = "The list that you provided does not exists!";
			return False;
		}catch(Exception $e){
			Mailchimp_Social_WP::sendError(print_r($e, true), "Handling.class.php", "24");
			$error = $e->getMessage();
			$response = "ERRO"; 
			return False;
		}
		return True;
	}

	public static function make_transient($email=NULL, $first_name=NULL, $last_name=NULL, $dateofbirth_day=NULL, $dateofbirth_month=NULL, $service=NULL){
		if(!is_null($email)){
			$profile['email'] = $email;
		}
		if(!is_null($first_name)){
			$profile['first_name'] = $first_name;
		}
		if(!is_null($last_name)){
			$profile['last_name'] = $last_name;
		}
		if(!is_null($dateofbirth_day)){
			$profile['dateofbirth_day'] = $dateofbirth_day;
		}
		if(!is_null($dateofbirth_month)){
			$profile['dateofbirth_month'] = $dateofbirth_month;
		}
		if(!is_null($service)){
			$profile['service'] = $service;
		}
		if(!isset($profile) || !is_array($profile)){
			return NULL;
		}
		$identifier = md5(time());
		#save the entry
		set_transient($identifier, json_encode($profile), 120);
		return $identifier;
	}

	public static function obtain_transient($transient){
		if(false === ($value = get_transient($transient))){
		    return NULL;
		}else{
			return json_decode($value, true);
		}
	}

	public static function handling_transient($post_variables, $birth_tag=NULL){
		global $activeExtras, $Configuration;
		$merge_tags = self::ative_merge_tags();
		
		$transient = self::obtain_transient($post_variables['profile_identifier']);
		if(!isset($transient)){
			#erro!
		}
		extract($transient);
		if(!isset($email)){
			$email = @$post_variables['email'];
			$activeExtras['confirm_'.$service] = True;
		}
		if(!$Configuration["disable_flname"]):
			if(!isset($first_name)){
				$array["FNAME"] = @$post_variables['first_name'];
			}else{
				$array["FNAME"] = $first_name;
			}
			if(!isset($last_name)){
				$array["LNAME"] = @$post_variables['last_name'];
			}else{
				$array["LNAME"] = $last_name;
			}
		endif;

		if(count($merge_tags)>0){
			foreach ($merge_tags as $key => $value) {
				$array[$value["tag"]] = @$post_variables[$value["name"]];
			}
		}

		if(!$Configuration["disable_birthday"]):
			if(isset($dateofbirth_day) && isset($dateofbirth_month)){
				$day = $dateofbirth_day;
				$month = $dateofbirth_month;
			}elseif(isset($post_variables["dateofbirth_day"]) && isset($post_variables["dateofbirth_month"])){
				$day = $post_variables["dateofbirth_day"];
				$month = $post_variables["dateofbirth_month"];
			}

			if(isset($day) && isset($month)){
				$date_parsing = strtotime($day."-".$month."-".date("Y"));
				$array[$birth_tag] = date('m/d', $date_parsing);
			}
		endif;

		self::handling_request($email, $array, $post_variables["lists"], $service);
	}

	public static function make_merge_tags(){
		if(!get_option("Mailchimp_ApiKey") || !get_option("Mailchimp_ListID")){
			return array();
		}
		/*
		Array ( [ae132a766b296481fb2d613b8ee46d53] => Array ( [field_type] => radio [choices] => Array ( [0] => YES [1] => NO ) [tag] => HAPPY [name] => happy [label] => happy ) [a41dccd59de4e00dc115ef04a9b02963] => Array ( [field_type] => radio [choices] => Array ( [0] => YES [1] => I don't know [2] => NO ) [tag] => FUN [name] => fun [label] => fun ) )
		*/
        $instance = new MSW_Mailchimp(get_option("Mailchimp_ApiKey"));
		$array_merge_tags = array();
        foreach (get_option("Mailchimp_ListID") as $key => $list_id) {
            if(!(false === ($vars = $instance->lists->mergeVars(array($list_id))))){
                foreach ($vars as $key => $value) {
                    if(is_array($value)){
                        foreach ($value as $key => $value) {
                            if(isset($value['merge_vars'])){
                                foreach ($value['merge_vars'] as $key => $value) {
                                    if($value["field_type"]=="radio"):
                                        $array_merge_tags[md5($value['name'].$list_id)] = array("field_type" => "radio",
                                                  "choices" => $value["choices"],
                                                  "tag" => $value["tag"],
                                                  "name" => $value['name'],
                                                  "label" => $value['name'],
                                    			  "req" => $value['req']);
                                    endif;
                                }
                            }
                        }   
                    }
                }
            }
        }
        return $array_merge_tags;
    }

    public static function ative_merge_tags(){
    	$merge_tags = self::make_merge_tags();
    	$keys = array_keys($merge_tags);
    	$ative_merge_tags = array();
    	foreach ($keys as $key => $value) {
    		if(get_option($value)){
    			array_push($ative_merge_tags, $merge_tags[$value]);
    		}
    	}
    	return $ative_merge_tags;
    }

	private static function handling_this($response = NULL, $error = NULL, $service = NULL){
		global $responsePage, $activeExtras;
		if(isset($response) && !is_null($response)){
        	if($response == "List_AlreadySubscribed"){
            	header("Location: ".$responsePage["repeated"]);
            }else{
            	if(!is_null($error)){
					header("Location: ".$responsePage["error"]."?error=".$error);
            	}else{
					header("Location: ".$responsePage["error"]);
            	}
            }
        }else{
        	if($activeExtras['confirm_'.$service]){
           		header("Location: ".$responsePage["success"]."?please=confirm");
        	}else{
           		header("Location: ".$responsePage["success"]);
        	}
        }
	}

	public static function curlHttpRequest($url, $method = "get", $request_fields = array()) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

		if($method == "post"){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $request_fields);
		}else if($method == "get"){
			curl_setopt($ch, CURLOPT_HTTPGET, true);
		}else if($method == "del"){
    		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		$result =  curl_exec($ch);
		if($result === false){
			print_r(curl_error($ch));
			echo "<br/>If is a connection problem please see this: <a href=\"http://www.businesscorner.co.uk/disable-ipv6-in-curl-and-php/\">http://www.businesscorner.co.uk/disable-ipv6-in-curl-and-php/</a>";
            exit();
		}else{
			return $result;
		}
	}
}