<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("SELECT $trades_content.$id, $inventory.$user FROM $trades_content INNER JOIN $inventory ON $trades_content.$item=$inventory.$id WHERE $trade_id = %s", 
			   mysql_real_escape_string($_POST['trade_id']));

//json_encode($wpdb->get_results($sql));

$tradeContent = $wpdb->get_results($sql);

$result = array();

foreach ($tradeContent as $item){
	if($item[$user] === $_POST['owner_id']){
		//CHANGE OWNERSHIP OF ITEM
	}
}

echo json_encode($result);

?>