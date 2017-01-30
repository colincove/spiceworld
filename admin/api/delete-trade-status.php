<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("DELETE FROM $trades_states WHERE $id = %s", 
			  $_POST['id']);

$wpdb->query($sql);

?>