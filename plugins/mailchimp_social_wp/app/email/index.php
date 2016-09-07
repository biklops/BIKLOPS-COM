<?php
/**
 *          RAFAEL FERREIRA © 2014 || MailChimp Social Wordpress
 * ------------------------------------------------------------------------
 *                      ** Facebook **
 * ------------------------------------------------------------------------
 */
require_once("../Configuration.php");
/*
if(!$ActiveServices["email"]){
    exit("Service not active!");
}
*/
require_once("../classes/Handling.class.php");
$transient = Handling::make_transient(@urldecode(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL)), NULL, NULL, NULL, NULL, 'form');
require_once("../endpoint/index.php");