<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

foreach ($tables as $table => $value)
{
	$wpdb->query( "DROP TABLE IF EXISTS $table" );
}

echo "Uninstall Success";

?>