<?php

require_once 'MSW_Mailchimp/Users.php';
require_once 'MSW_Mailchimp/Helper.php';
require_once 'MSW_Mailchimp/Lists.php';
require_once 'MSW_Mailchimp/Exceptions.php';

class MSW_Mailchimp {
    
    public $apikey;
    public $ch;
    public $root  = 'https://api.mailchimp.com/2.0';
    public $debug = false;

    public static $error_map = array(
        "ValidationError" => "MSW_Mailchimp_ValidationError",
        "ServerError_MethodUnknown" => "MSW_Mailchimp_ServerError_MethodUnknown",
        "ServerError_InvalidParameters" => "MSW_Mailchimp_ServerError_InvalidParameters",
        "Unknown_Exception" => "MSW_Mailchimp_Unknown_Exception",
        "Request_TimedOut" => "MSW_Mailchimp_Request_TimedOut",
        "Zend_Uri_Exception" => "MSW_Mailchimp_Zend_Uri_Exception",
        "PDOException" => "MSW_Mailchimp_PDOException",
        "Avesta_Db_Exception" => "MSW_Mailchimp_Avesta_Db_Exception",
        "XML_RPC2_Exception" => "MSW_Mailchimp_XML_RPC2_Exception",
        "XML_RPC2_FaultException" => "MSW_Mailchimp_XML_RPC2_FaultException",
        "Too_Many_Connections" => "MSW_Mailchimp_Too_Many_Connections",
        "Parse_Exception" => "MSW_Mailchimp_Parse_Exception",
        "User_Unknown" => "MSW_Mailchimp_User_Unknown",
        "User_Disabled" => "MSW_Mailchimp_User_Disabled",
        "User_DoesNotExist" => "MSW_Mailchimp_User_DoesNotExist",
        "User_NotApproved" => "MSW_Mailchimp_User_NotApproved",
        "Invalid_ApiKey" => "MSW_Mailchimp_Invalid_ApiKey",
        "User_UnderMaintenance" => "MSW_Mailchimp_User_UnderMaintenance",
        "Invalid_AppKey" => "MSW_Mailchimp_Invalid_AppKey",
        "Invalid_IP" => "MSW_Mailchimp_Invalid_IP",
        "User_DoesExist" => "MSW_Mailchimp_User_DoesExist",
        "User_InvalidRole" => "MSW_Mailchimp_User_InvalidRole",
        "User_InvalidAction" => "MSW_Mailchimp_User_InvalidAction",
        "User_MissingEmail" => "MSW_Mailchimp_User_MissingEmail",
        "User_CannotSendCampaign" => "MSW_Mailchimp_User_CannotSendCampaign",
        "User_MissingModuleOutbox" => "MSW_Mailchimp_User_MissingModuleOutbox",
        "User_ModuleAlreadyPurchased" => "MSW_Mailchimp_User_ModuleAlreadyPurchased",
        "User_ModuleNotPurchased" => "MSW_Mailchimp_User_ModuleNotPurchased",
        "User_NotEnoughCredit" => "MSW_Mailchimp_User_NotEnoughCredit",
        "MC_InvalidPayment" => "MSW_Mailchimp_MC_InvalidPayment",
        "List_DoesNotExist" => "MSW_Mailchimp_List_DoesNotExist",
        "List_InvalidInterestFieldType" => "MSW_Mailchimp_List_InvalidInterestFieldType",
        "List_InvalidOption" => "MSW_Mailchimp_List_InvalidOption",
        "List_InvalidUnsubMember" => "MSW_Mailchimp_List_InvalidUnsubMember",
        "List_InvalidBounceMember" => "MSW_Mailchimp_List_InvalidBounceMember",
        "List_AlreadySubscribed" => "MSW_Mailchimp_List_AlreadySubscribed",
        "List_NotSubscribed" => "MSW_Mailchimp_List_NotSubscribed",
        "List_InvalidImport" => "MSW_Mailchimp_List_InvalidImport",
        "MC_PastedList_Duplicate" => "MSW_Mailchimp_MC_PastedList_Duplicate",
        "MC_PastedList_InvalidImport" => "MSW_Mailchimp_MC_PastedList_InvalidImport",
        "Email_AlreadySubscribed" => "MSW_Mailchimp_Email_AlreadySubscribed",
        "Email_AlreadyUnsubscribed" => "MSW_Mailchimp_Email_AlreadyUnsubscribed",
        "Email_NotExists" => "MSW_Mailchimp_Email_NotExists",
        "Email_NotSubscribed" => "MSW_Mailchimp_Email_NotSubscribed",
        "List_MergeFieldRequired" => "MSW_Mailchimp_List_MergeFieldRequired",
        "List_CannotRemoveEmailMerge" => "MSW_Mailchimp_List_CannotRemoveEmailMerge",
        "List_Merge_InvalidMergeID" => "MSW_Mailchimp_List_Merge_InvalidMergeID",
        "List_TooManyMergeFields" => "MSW_Mailchimp_List_TooManyMergeFields",
        "List_InvalidMergeField" => "MSW_Mailchimp_List_InvalidMergeField",
        "List_InvalidInterestGroup" => "MSW_Mailchimp_List_InvalidInterestGroup",
        "List_TooManyInterestGroups" => "MSW_Mailchimp_List_TooManyInterestGroups",
        "Campaign_DoesNotExist" => "MSW_Mailchimp_Campaign_DoesNotExist",
        "Campaign_StatsNotAvailable" => "MSW_Mailchimp_Campaign_StatsNotAvailable",
        "Campaign_InvalidAbsplit" => "MSW_Mailchimp_Campaign_InvalidAbsplit",
        "Campaign_InvalidContent" => "MSW_Mailchimp_Campaign_InvalidContent",
        "Campaign_InvalidOption" => "MSW_Mailchimp_Campaign_InvalidOption",
        "Campaign_InvalidStatus" => "MSW_Mailchimp_Campaign_InvalidStatus",
        "Campaign_NotSaved" => "MSW_Mailchimp_Campaign_NotSaved",
        "Campaign_InvalidSegment" => "MSW_Mailchimp_Campaign_InvalidSegment",
        "Campaign_InvalidRss" => "MSW_Mailchimp_Campaign_InvalidRss",
        "Campaign_InvalidAuto" => "MSW_Mailchimp_Campaign_InvalidAuto",
        "MC_ContentImport_InvalidArchive" => "MSW_Mailchimp_MC_ContentImport_InvalidArchive",
        "Campaign_BounceMissing" => "MSW_Mailchimp_Campaign_BounceMissing",
        "Campaign_InvalidTemplate" => "MSW_Mailchimp_Campaign_InvalidTemplate",
        "Invalid_EcommOrder" => "MSW_Mailchimp_Invalid_EcommOrder",
        "Absplit_UnknownError" => "MSW_Mailchimp_Absplit_UnknownError",
        "Absplit_UnknownSplitTest" => "MSW_Mailchimp_Absplit_UnknownSplitTest",
        "Absplit_UnknownTestType" => "MSW_Mailchimp_Absplit_UnknownTestType",
        "Absplit_UnknownWaitUnit" => "MSW_Mailchimp_Absplit_UnknownWaitUnit",
        "Absplit_UnknownWinnerType" => "MSW_Mailchimp_Absplit_UnknownWinnerType",
        "Absplit_WinnerNotSelected" => "MSW_Mailchimp_Absplit_WinnerNotSelected",
        "Invalid_Analytics" => "MSW_Mailchimp_Invalid_Analytics",
        "Invalid_DateTime" => "MSW_Mailchimp_Invalid_DateTime",
        "Invalid_Email" => "MSW_Mailchimp_Invalid_Email",
        "Invalid_SendType" => "MSW_Mailchimp_Invalid_SendType",
        "Invalid_Template" => "MSW_Mailchimp_Invalid_Template",
        "Invalid_TrackingOptions" => "MSW_Mailchimp_Invalid_TrackingOptions",
        "Invalid_Options" => "MSW_Mailchimp_Invalid_Options",
        "Invalid_Folder" => "MSW_Mailchimp_Invalid_Folder",
        "Invalid_URL" => "MSW_Mailchimp_Invalid_URL",
        "Module_Unknown" => "MSW_Mailchimp_Module_Unknown",
        "MonthlyPlan_Unknown" => "MSW_Mailchimp_MonthlyPlan_Unknown",
        "Order_TypeUnknown" => "MSW_Mailchimp_Order_TypeUnknown",
        "Invalid_PagingLimit" => "MSW_Mailchimp_Invalid_PagingLimit",
        "Invalid_PagingStart" => "MSW_Mailchimp_Invalid_PagingStart",
        "Max_Size_Reached" => "MSW_Mailchimp_Max_Size_Reached",
        "MC_SearchException" => "MSW_Mailchimp_MC_SearchException",
        "Goal_SaveFailed" => "MSW_Mailchimp_Goal_SaveFailed",
        "Conversation_DoesNotExist" => "MSW_Mailchimp_Conversation_DoesNotExist",
        "Conversation_ReplySaveFailed" => "MSW_Mailchimp_Conversation_ReplySaveFailed",
        "File_Not_Found_Exception" => "MSW_Mailchimp_File_Not_Found_Exception",
        "Folder_Not_Found_Exception" => "MSW_Mailchimp_Folder_Not_Found_Exception",
        "Folder_Exists_Exception" => "MSW_Mailchimp_Folder_Exists_Exception"
    );

    public function __construct($apikey=null, $opts=array()) {
        if (!$apikey) {
            $apikey = getenv('MAILCHIMP_APIKEY');
        }

        if (!$apikey) {
            $apikey = $this->readConfigs();
        }

        if (!$apikey) {
            throw new MSW_Mailchimp_Error('You must provide a MailChimp API key');
        }

        $this->apikey = $apikey;
        $dc           = "us1";

        if (strstr($this->apikey, "-")){
            list($key, $dc) = explode("-", $this->apikey, 2);
            if (!$dc) {
                $dc = "us1";
            }
        }

        $this->root = str_replace('https://api', 'https://' . $dc . '.api', $this->root);
        $this->root = rtrim($this->root, '/') . '/';

        if (!isset($opts['timeout']) || !is_int($opts['timeout'])){
            $opts['timeout'] = 600;
        }
        if (isset($opts['debug'])){
            $this->debug = true;
        }


        $this->ch = curl_init();

        if (isset($opts['CURLOPT_FOLLOWLOCATION']) && $opts['CURLOPT_FOLLOWLOCATION'] === true) {
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);    
        }

        curl_setopt($this->ch, CURLOPT_USERAGENT, 'MailChimp-PHP/2.0.5');
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $opts['timeout']);


        $this->users = new MSW_Mailchimp_Users($this);
        $this->helper = new MSW_Mailchimp_Helper($this);
        $this->lists = new MSW_Mailchimp_Lists($this);
    }

    public function __destruct() {
        curl_close($this->ch);
    }

    public function call($url, $params) {
        $params['apikey'] = $this->apikey;
        
        $params = json_encode($params);
        $ch     = $this->ch;

        curl_setopt($ch, CURLOPT_URL, $this->root . $url . '.json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $start = microtime(true);
        $this->log('Call to ' . $this->root . $url . '.json: ' . $params);
        if($this->debug) {
            $curl_buffer = fopen('php://memory', 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
        }

        $response_body = curl_exec($ch);

        $info = curl_getinfo($ch);
        $time = microtime(true) - $start;
        if($this->debug) {
            rewind($curl_buffer);
            $this->log(stream_get_contents($curl_buffer));
            fclose($curl_buffer);
        }
        $this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
        $this->log('Got response: ' . $response_body);

        if(curl_error($ch)) {
            throw new MSW_Mailchimp_HttpError("API call to $url failed: " . curl_error($ch));
        }
        $result = json_decode($response_body, true);
        
        if(floor($info['http_code'] / 100) >= 4) {
            throw $this->castError($result);
        }

        return $result;
    }

    public function readConfigs() {
        $paths = array('~/.mailchimp.key', '/etc/mailchimp.key');
        foreach($paths as $path) {
            if(file_exists($path)) {
                $apikey = trim(file_get_contents($path));
                if ($apikey) {
                    return $apikey;
                }
            }
        }
        return false;
    }

    public function castError($result) {
        if ($result['status'] !== 'error' || !$result['name']) {
            throw new MSW_Mailchimp_Error('We received an unexpected error: ' . json_encode($result));
        }

        $class = (isset(self::$error_map[$result['name']])) ? self::$error_map[$result['name']] : 'MSW_Mailchimp_Error';
        return new $class($result['error'], $result['code']);
    }

    public function log($msg) {
        if ($this->debug) {
            error_log($msg);
        }
    }
}

