<?php


include( MY_PLUGIN_PATH . 'redirects-config.php');

add_action( 'init', 'spiceworld_init_internal' );
function spiceworld_init_internal()
{
	global $redirect_config;

	foreach ($redirect_config as $key => $value) {
		add_rewrite_rule( $value['pattern'].'$', 'index.php?'.$key.'=1', 'top' );	
	}
}

add_filter( 'query_vars', 'spiceworld_query_vars' );
function spiceworld_query_vars( $query_vars )
{
	global $redirect_config;
	
	foreach ($redirect_config as $key => $value) {
		$query_vars[] = $key;
	}

    return $query_vars;
}

add_action( 'parse_request', 'spiceworld_parse_request' );
function spiceworld_parse_request( &$wp )
{
	global $redirect_config;
	
	foreach ($redirect_config as $key => $value) {
		 if ( array_key_exists( $key, $wp->query_vars ) ) {
			include $value['include'];
			exit();
		} 
	}
    return;
}

?>