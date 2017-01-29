<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $items (name, value) VALUES ('%s', %s)",
            mysql_real_escape_string($_POST['name']), 
			mysql_real_escape_string($_POST['value']));

//execute table creation
$wpdb->query( $sql );

?>