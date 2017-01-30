<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("INSERT INTO $trades (owner, target, message) VALUES (%s, %s, '%s')",
            $_POST['owner'], 
			$_POST['target'], 
			$_POST['message']);

//execute table creation
$wpdb->query( $sql );

$newTradeRow = $wpdb->insert_id;


foreach ($_POST['offerItems'] as $key) {
	// Query
	$sql = sprintf("INSERT INTO $trades_content (item, trade_id) VALUES (%s, %s)",
				$key, 
				$newTradeRow);
	$wpdb->query( $sql );
}

foreach ($_POST['requestItems'] as $key) {
	// Query
	$sql = sprintf("INSERT INTO $trades_content (item, trade_id) VALUES (%s, %s)",
				$key, 
				$newTradeRow);
	$wpdb->query( $sql );
}
	
?>