<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $inventory (user, item) VALUES (%s, %s)",
            mysql_real_escape_string($_POST['user']), 
			mysql_real_escape_string($_POST['item']));

//execute table creation
$wpdb->query( $sql );

?>