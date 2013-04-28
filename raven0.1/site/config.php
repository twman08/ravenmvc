<?php
error_reporting(-1);
ini_set('display_errors', 1);

$ra->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
$ra->config['timezone'] = 'Europe/Stockholm';
$ra->config['character_encoding'] = 'UTF-8';
$ra->config['language'] = 'en';
$ra->config['base_url'] = null;

$ra->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
);

$ra->config['theme'] = array(
  'name'    => 'core', 
);

    /**
    * What type of urls should be used?
    *
    * default      = 0      => index.php/controller/method/arg1/arg2/arg3
    * clean        = 1      => controller/method/arg1/arg2/arg3
    * querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
    */
    $ra->config['url_type'] = 1;

