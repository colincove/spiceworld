<?php 


require_once(MY_PLUGIN_PATH."localization.php");

global $loc;

$context = Timber::get_context();

$context['plugins'] = plugin_dir_url( __FILE__ );
$context['loc'] = json_encode($loc); 

Timber::render( array( 'templates/admin.twig' ), $context );

?>