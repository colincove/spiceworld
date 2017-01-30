<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
/*$sql = sprintf("SELECT $inventory.$id, $items.$name FROM $inventory INNER JOIN $items ON $inventory.$item=$items.$id WHERE $user = %s", 
			   $_POST['id']);*/
$sql = sprintf("SELECT * FROM $inventory WHERE $user=%s AND $id NOT IN (SELECT item FROM $trades_content)", 
			   $_POST['id']);

echo json_encode($wpdb->get_results($sql));

?>