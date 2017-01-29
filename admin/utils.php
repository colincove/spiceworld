<?php 

class UTILS_CLASS
{
	//Take the redults of a sql SELECT query and return it as a JSON encoded string value
   function sql_result_encode($sql_result)
   {
		$rows = array();
		while($r = mysqli_fetch_assoc($sql_result))
		{
			$rows[] = $r;
		}

		return json_encode($rows);
   }
}


$Utils = new UTILS_CLASS;



?>