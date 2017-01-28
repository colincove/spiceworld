<?php

global $redirect_config;

//preprended to all url patterns
$home = "spiceworld";

$redirect_config = array();

/** CLIENT */

$redirect_config['home'] = array('pattern'=>$home, 'include'=>'home/index.php');
$redirect_config['admin'] = array('pattern'=>$home.'/admin', 'include'=>'admin/index.php');
$redirect_config['trade_create'] = array('pattern'=>$home.'/trade/create', 'include'=>'api/create-trade.php');
$redirect_config['get_user'] = array('pattern'=>$home.'/user/massinfo', 'include'=>'api/user-info.php');
$redirect_config['trade_update'] = array('pattern'=>$home.'/trade/update', 'include'=>'api/set-trade-state.php');
$redirect_config['get_trades'] = array('pattern'=>$home.'/trade/get', 'include'=>'api/get-user-trades.php');
$redirect_config['user_inventory'] = array('pattern'=>$home.'/user/inventory', 'include'=>'api/get-inventory.php');

/** ADMIN */

//append to all admin redirects's
$admin = "/admin";

$redirect_config['create_trade_status'] = array('pattern'=>$home.$admin.'/trades/status/create', 'include'=>'admin/api/create-status.php');
$redirect_config['trades_status_get'] = array('pattern'=>$home.$admin.'/trades/status/get', 'include'=>'admin/api/get-status-enum.php');
$redirect_config['items_create'] = array('pattern'=>$home.$admin.'/items/create', 'include'=>'admin/api/create-item.php');
$redirect_config['items_get'] = array('pattern'=>$home.$admin.'/items/get', 'include'=>'admin/api/get-items.php');
$redirect_config['items_grant'] = array('pattern'=>$home.$admin.'/items/grant', 'include'=>'admin/api/grant-item.php');
$redirect_config['install'] = array('pattern'=>$home.$admin.'/install', 'include'=>'admin/api/install.php');
$redirect_config['uninstall'] = array('pattern'=>$home.$admin.'/uninstall', 'include'=>'admin/api/uninstall.php');

?>