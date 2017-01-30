<?php 


include( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

foreach ($tables as $table => $value)
{
	$wpdb->query( "DROP TABLE IF EXISTS $table" );
}

echo "Uninstall Success";

?>

