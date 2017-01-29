<?php 

define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

// Query
$sql = sprintf("SELECT $trades.$id, $trades.$owner, $trades.$target, $users.user_nicename FROM $trades INNER JOIN $users ON $trades.$target=$users.$id WHERE $target = %s", 
			   mysql_real_escape_string($_POST['user_id']));

echo json_encode($wpdb->get_results($sql));

?>