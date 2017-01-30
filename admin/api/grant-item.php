<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $inventory (user, item) VALUES (%s, %s)",
            $_POST['user'], 
			$_POST['item']);

//execute table creation
$wpdb->query( $sql );

?>