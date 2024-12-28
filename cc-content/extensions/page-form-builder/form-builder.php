<?php 

/*define base extension*/
$base_url_extension = url_extension(basename(__DIR__)); 

/*register script file*/
$script = <<<SCRIPT
var BASE_URL_EXT = "$base_url_extension";
SCRIPT;

$cc_core->load->library('cc_html');
$cc_core->cc_html->registerScriptFile( $script, 'script');
$cc_core->cc_html->registerScriptFile( $base_url_extension.'/form-builder-ext.js');


?>