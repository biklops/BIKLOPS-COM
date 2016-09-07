<?php
require_once("../Configuration.php");
require_once("../classes/MailChimp/mailchimp.php");
require_once("../classes/Handling.class.php");
$instance = new MSW_Mailchimp($Configuration["Mailchimp_ApiKey"]);

function has_birthday($id){
	global $instance;
	if(false === ($vars = $instance->lists->mergeVars(array($id)))){
		return FALSE;
	}else{
		foreach ($vars as $key => $value) {
			if(is_array($value)){
				foreach ($value as $key => $value) {
					if(isset($value['merge_vars'])){
						foreach ($value['merge_vars'] as $key => $value) {
							if($value["field_type"]=="birthday"){
								return $value["tag"];
							}
						}
					}
				}	
			}
		}
		return FALSE;
	}
}

/*
function has_merge_var($list_id, $merge_tag){
	global $instance;
	if(false === ($vars = $instance->lists->mergeVars(array($list_id)))){
		return FALSE;
	}else{
		foreach ($vars as $key => $value) {
			if(is_array($value)){
				foreach ($value as $key => $value) {
					if(isset($value['merge_vars'])){
						foreach ($value['merge_vars'] as $key => $value) {
							if($value['name']==$merge_tag['name'] && $value["tag"]==$merge_tag['tag'] && $value["tag"]==$merge_tag['tag'] && $value["choices"]==$merge_tag['choices']){
								return TRUE;
							}
						}
					}
				}	
			}
		}
		return FALSE;
	}
}

function create_merge_var($list_id, $merge_tag){
	global $instance;
	try{
		$instance->lists->mergeVarAdd($list_id, $merge_tag["tag"], $merge_tag["name"], $options=array("field_type" => $merge_tag["field_type"], "choices" => $merge_tag["choices"]));
	}catch(MSW_Mailchimp_List_InvalidMergeField $e){
		#
	}
}
*/

if(!isset($_POST['lists'])){
	try{
        $mailchimp = new MSW_Mailchimp(get_option("Mailchimp_ApiKey"));
        $lists_info = $mailchimp->lists->getList();
    }catch(Exception $e){
        exit("Something went wrong. Proabably the Mailchimp API Key is invalid!");
    }
    $lists = array();
    foreach ($lists_info['data'] as $list) {
    	$lists[$list['id']] = $list['name'];
    }
    $_POST["lists"] = array();
    foreach ($lists as $key => $value) {
		if(in_array($key, $Configuration["Mailchimp_ListID"])){
			array_push($_POST["lists"], $key);
    	}	
	}
	$_POST['profile_identifier'] = $_GET['profile_identifier'];
}elseif(!is_array($_POST['lists'])){
	$_POST["lists"] = array(0 => $_POST["lists"]);
}

if(!$Configuration["disable_birthday"]):
	foreach ($_POST['lists'] as $key => $value) {
		if(!($tag = has_birthday($value))){
			try{
				$instance->lists->mergeVarAdd($value, "BIRTHDAY", "birthday", $options=array("field_type" => "birthday"));
			}catch(MSW_Mailchimp_List_InvalidMergeField $e){

			}
			$tag = has_birthday($value);
		}
		/*
		foreach ($merge_tags as $key => $merge_tag) {
			if(!has_merge_var($value, $merge_tag)){
				create_merge_var($value, $merge_tag);
			}
		}
		*/
	}
endif;

Handling::handling_transient($_POST, $tag);

?>