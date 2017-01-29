<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $trades (owner, target, message) VALUES (%s, %s, '%s')",
            mysql_real_escape_string($_POST['owner']), 
			mysql_real_escape_string($_POST['target']), 
			mysql_real_escape_string($_POST['message']));

//execute table creation
$wpdb->query( $sql );

$newTradeRow = $wpdb->insert_id;


foreach ($_POST['offerItems'] as $key) {
	// Query
	$sql = sprintf("INSERT INTO $trades_content (item, trade_id) VALUES (%s, %s)",
				mysql_real_escape_string($key), 
				mysql_real_escape_string($newTradeRow));
	$wpdb->query( $sql );
}

foreach ($_POST['requestItems'] as $key) {
	// Query
	$sql = sprintf("INSERT INTO $trades_content (item, trade_id) VALUES (%s, %s)",
				mysql_real_escape_string($key), 
				mysql_real_escape_string($newTradeRow));
	$wpdb->query( $sql );
}
	
?>