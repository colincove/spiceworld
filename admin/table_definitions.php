<?php

$tables = array();

/** String definitions */
$constraints = "contraints";
$defs = "defs";
$primary_key = "primary_key";
$foreign_key = "foreign_key";
$rows = "rows";

/********************************************************************/
/**********************	      TABLES		*************************/
/********************************************************************/

$prefix = "spiceworld_";

/**********************	      ITEMS  		*************************/

//Table Names
$users = "wp_users";
$items = $prefix."items";
$trades_states = $prefix."trades_states";
$trades_content = $prefix."trades_content";
$trades = $prefix."trades";
$inventory = $prefix."inventory";

/* Row Titles */
$id = "ID";
$name = "name";
$value = "value";
$item = "item";
$user = "user";
$owner = "owner";
$target = "target";
$message = "message";
$date = "date";
$last_updated = "last_updated";
$trade_id="trade_id";

/* Items */

$tables[$items] = array();
$tables[$items][$rows] = array();

$tables[$items][$rows][$id] = array();
$tables[$items][$rows][$id][$constraints] = array("bigint(20)", "NOT NULL", "AUTO_INCREMENT");
$tables[$items][$rows][$name] = array();
$tables[$items][$rows][$name][$constraints] = array("varchar(255)");
$tables[$items][$rows][$value] = array();
$tables[$items][$rows][$value][$constraints] = array("int(11)");

$tables[$items][$primary_key] = $id;

/* trades_states */

$tables[$trades_states] = array();
$tables[$trades_states][$rows] = array();

$tables[$trades_states][$rows][$id] = array();
$tables[$trades_states][$rows][$id][$constraints] = array("bigint(20)", "NOT NULL", "AUTO_INCREMENT");
$tables[$trades_states][$rows][$name] = array();
$tables[$trades_states][$rows][$name][$constraints] = array("varchar(255)");

$tables[$trades_states][$primary_key] = $id;

/* inventory */

$tables[$inventory] = array();
$tables[$inventory][$rows] = array();

$tables[$inventory][$rows][$id] = array();
$tables[$inventory][$rows][$id][$constraints] = array("bigint(20)", "NOT NULL", "AUTO_INCREMENT");
$tables[$inventory][$rows][$item] = array();
$tables[$inventory][$rows][$item][$constraints] = array("int(255)", "NOT NULL");
$tables[$inventory][$rows][$user] = array();
$tables[$inventory][$rows][$user][$constraints] = array("bigint(20)", "NOT NULL");

$tables[$inventory][$primary_key] = $id;
//TODO: For some reason, we cannot use a FOREIGN KEY against the user. Find out why. Fix it. 
//$tables[$inventory][$foreign_keys] = array("($item)" => "$items ($id)", "($user)" => "$users ($id)");
//$tables[$inventory][$foreign_keys] = array("($item)" => "$items ($id)");

/* trades */

$tables[$trades] = array();
$tables[$trades][$rows] = array();

$tables[$trades][$rows][$id] = array();
$tables[$trades][$rows][$id][$constraints] = array("bigint(20)", "NOT NULL", "AUTO_INCREMENT");
$tables[$trades][$rows][$message] = array();
$tables[$trades][$rows][$message][$constraints] = array("varchar(255)");
$tables[$trades][$rows][$owner] = array();
$tables[$trades][$rows][$owner][$constraints] = array("bigint(20)", "NOT NULL");
$tables[$trades][$rows][$target] = array();
$tables[$trades][$rows][$target][$constraints] = array("bigint(20)", "NOT NULL");
$tables[$trades][$rows][$date] = array();
$tables[$trades][$rows][$date][$constraints] = array("TIMESTAMP",  "DEFAULT CURRENT_TIMESTAMP");
$tables[$trades][$rows][$last_updated] = array();
$tables[$trades][$rows][$last_updated][$constraints] = array("TIMESTAMP",  "DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");

$tables[$trades][$primary_key] = $id;

/* trades content */

$tables[$trades_content] = array();
$tables[$trades_content][$rows] = array();

$tables[$trades_content][$rows][$id] = array();
$tables[$trades_content][$rows][$id][$constraints] = array("bigint(20)", "NOT NULL", "AUTO_INCREMENT");
$tables[$trades_content][$rows][$item] = array();
$tables[$trades_content][$rows][$item][$constraints] = array("bigint(20)", "NOT NULL");
$tables[$trades_content][$rows][$trade_id] = array();
$tables[$trades_content][$rows][$trade_id][$constraints] = array("bigint(20)", "NOT NULL");

$tables[$trades_content][$primary_key] = $id;
$tables[$trades_content][$foreign_keys] = array("($item)" => "$inventory ($id)", "($trade_id)" => "$trades ($id)");

?>