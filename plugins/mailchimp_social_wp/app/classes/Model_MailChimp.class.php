<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** MailChimp Class    **
 * ------------------------------------------------------------------------
 */
require_once("MailChimp/mailchimp.php");

class Model_MailChimp{
    public static function subscribe($email, $merge_vars, $list_id) {
        global $Configuration;
        $instance = new MSW_Mailchimp($Configuration["Mailchimp_ApiKey"]);
        if(!is_null($var = parse_groupings($list_id))){
            $merge_vars = array_merge($merge_vars, $var);
        }
        $instance->lists->subscribe($list_id, array("email" => $email), $merge_vars, 'html', false);
    }

    public static function subscribe_with_confirmation($email, $merge_vars, $list_id) {
        global $Configuration;
        $instance = new MSW_Mailchimp($Configuration["Mailchimp_ApiKey"]);
        if(!is_null($var = parse_groupings($list_id))){
            $merge_vars = array_merge($merge_vars, $var);
        }
        $instance->lists->subscribe($list_id, array("email" => $email), $merge_vars);
    }

    public static function get_groups_list(){
        global $Configuration;
        $instance = new MSW_Mailchimp($Configuration["Mailchimp_ApiKey"]);
        return $instance->lists->interestGroupings($Configuration["Mailchimp_ListID"]);
    }
}