<?php 


require_once(MY_PLUGIN_PATH."localization.php");

global $loc;

$context = Timber::get_context();

$context['plugins'] = plugin_dir_url( __FILE__ );
$context['login_url'] = wp_login_url( $_SERVER["HTTP_HOST"]) .get_site_url()."/spiceworld";
$context['loc'] = json_encode($loc); 

if(is_user_logged_in()){
	Timber::render( array( 'templates/home.twig' ), $context );
}
else
{
	Timber::render( array( 'templates/user_login.twig' ), $context );
}
?>