<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("DELETE FROM $trades_states WHERE $id = %s", 
			  mysql_real_escape_string($_POST['id']));

$wpdb->query($sql);

?>