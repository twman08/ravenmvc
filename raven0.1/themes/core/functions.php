<?php
/**
 * Helpers for the template file.
 */
$ra->data['header'] = '<h1>Header: Raven</h1>';
$ra->data['main']   = '<p>Main: Now with a theme engine, Not much more to report for now.</p>';
$ra->data['footer'] = '<p>Footer: &copy; Raven by Tor Westman</p>';


/**
 * Print debuginformation from the framework.
 */
function get_debug() {
  $ra = CRaven::Instance();
  $html = "<h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($ra->config, true)) . "</pre>";
  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($ra->data, true)) . "</pre>";
  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($ra->request, true)) . "</pre>";
  return $html;
}