<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

$sql = sprintf("SELECT $inventory.$user, $inventory.$id FROM $trades_content INNER JOIN $inventory ON $trades_content.$item=$inventory.$id WHERE $trade_id = %s", 
			   $_POST['trade_id']);

$tradeContent = $wpdb->get_results($sql);

//CHANGE OWNERSHIP OF INVENTORY
foreach ($tradeContent as $item){
	$newOwner = $_POST['owner_id'];
	if($item->$user === $_POST['owner_id'])
	{
		$newOwner = $_POST['target_id'];
	}
	
	
	$sql = sprintf("UPDATE $inventory SET $user=%s WHERE $id=%s",
				   $newOwner, 
				   $item->$id);
	
	$wpdb->query($sql);
}

// Query
$sql = sprintf("DELETE FROM $trades_content WHERE $trade_id = %s", 
			  $_POST['trade_id']);

$wpdb->query($sql);


$sql = sprintf("DELETE FROM $trades WHERE $id = %s", 
			  $_POST['trade_id']);


$wpdb->query($sql);


?>