<?php 

/*
@ https://codex.wordpress.org/Creating_Tables_with_Plugins

You must put each field on its own line in your SQL statement.
You must have two spaces between the words PRIMARY KEY and the definition of your primary key.
You must use the key word KEY rather than its synonym INDEX and you must include at least one KEY.
KEY must be followed by a SINGLE SPACE then the key name then a space then open parenthesis with the field name then a closed parenthesis.
You must not use any apostrophes or backticks around field names.
Field types must be all lowercase.
SQL keywords, like CREATE TABLE and UPDATE, must be uppercase.
You must specify the length of all fields that accept a length parameter. int(11), for example.

'*/

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


include( MY_PLUGIN_PATH . 'admin/table_definitions.php');

global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$CREATE_TABLE = "CREATE TABLE";
$PRIMARY_KEY = "PRIMARY KEY";
$FOREIGN_KEY = "FOREIGN KEY";
$REFERENCES = "REFERENCES";

foreach ($tables as $table => $value)
{
	//Begin create table statement
	$sql = $CREATE_TABLE;
	
	$sql = $sql." ".$table." (";
	
	for ($i =0; $i < sizeof($tables[$table][$rows]); $i++)
	{
		//get row name
		$row = array_keys($tables[$table][$rows])[$i];
		
		//append row name to create row
		$sql = $sql."\r\n".$row;
		
		//add contraints
		foreach ($tables[$table][$rows][$row][$constraints] as  $value)
		{
			$sql = $sql." ".$value;
		}
		
		//append comma to seperate rows. Do not add if last row. 
		$sql = $i === sizeof($tables[$table][$rows]) - 1 ? $sql:$sql.", ";
	}
	
	//if primary key is defined, add it to the query
	if(isset($tables[$table][$primary_key]))
	{
		//must have 2 lines between primary key and value according to dbDelta
		$sql = $sql.", \r\n".$PRIMARY_KEY."  (".$tables[$table][$primary_key].")";
	}
	//if foreign key is defined, add it to the query
	if(isset($tables[$table][$foreign_keys]))
	{
		foreach ($tables[$table][$foreign_keys] as $row => $reference)
		{
			//must have 2 lines between primary key and value according to dbDelta
			$sql = $sql.", \r\n".$FOREIGN_KEY."  $row $REFERENCES $reference";
		}
	}
	
	$sql = $sql."\r\n) $charset_collate;";
	
	//execute table creation
	$wpdb->query( $sql );
	
	//UNCOMMENT when testing queries
	//echo nl2br($sql."</br></br>");
}

echo "Install Success";

?>