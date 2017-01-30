<?php 



require_once( MY_PLUGIN_PATH . 'admin/table_definitions.php');
require_once( MY_PLUGIN_PATH . 'admin/utils.php');

global $wpdb;

// Query
$sql = sprintf("SELECT $id, user_nicename FROM $users");

echo json_encode($wpdb->get_results($sql));

?>