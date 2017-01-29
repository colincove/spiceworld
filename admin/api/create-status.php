<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $trades_states (name) VALUES ('%s')",
            mysql_real_escape_string($_POST['name']));

//execute table creation
$wpdb->query( $sql );

?>