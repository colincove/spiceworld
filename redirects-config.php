<?php

global $redirect_config;

$home = "spiceworld";

$redirect_config = array();

$redirect_config['home'] = array('pattern'=>$home, 'include'=>'home/index.php');
$redirect_config['admin'] = array('pattern'=>$home.'/admin', 'include'=>'admin/index.php');
$redirect_config['trade_create'] = array('pattern'=>$home.'/trade/create', 'include'=>'api/create-trade.php');
$redirect_config['get_user'] = array('pattern'=>$home.'/user/massinfo', 'include'=>'api/user-info.php');
$redirect_config['trade_update'] = array('pattern'=>$home.'/trade/update', 'include'=>'api/set-trade-state.php');
$redirect_config['get_trades'] = array('pattern'=>$home.'/trade/get', 'include'=>'api/get-user-trades.php');
$redirect_config['user_inventory'] = array('pattern'=>$home.'/user/inventory', 'include'=>'api/get-inventory.php');

?>