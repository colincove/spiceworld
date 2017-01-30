<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $items (name, value) VALUES ('%s', %s)",
            $_POST['name'], 
			$_POST['value']);

//execute table creation
$wpdb->query( $sql );

?>