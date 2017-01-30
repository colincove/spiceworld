<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $trades_states (name) VALUES ('%s')",
            $_POST['name']);

//execute table creation
$wpdb->query( $sql );

?>