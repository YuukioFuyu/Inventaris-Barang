<?php 

/*define base extension*/
$base_url_extension = url_extension(basename(__DIR__)); 

/*register script*/
$script = 'var BASE_URL_EXTENSION = "'.$base_url_extension.'";';

$cc_core->load->library('cc_html');
$cc_core->cc_html->registerScriptFile($script, 'script');
$cc_core->cc_html->registerScriptFile($script, 'script');

/*register script file*/
$cc_core->cc_html->registerScriptFile( $base_url_extension.'/component.js');

?>