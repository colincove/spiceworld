<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

$context = Timber::get_context();

//$context['plugins'] = plugins_url();
$context['plugins'] = plugin_dir_url( __FILE__ );

Timber::render( array( 'templates/admin.twig' ), $context );

?>