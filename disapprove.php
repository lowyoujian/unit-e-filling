<?php
include('database_config.php');
	session_start();
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
$t = $_POST['t'];
$result_explode = explode('/', $t);
$path=$result_explode[0]; 
$unitcode=$result_explode[1]; 
$semester=$result_explode[2]; 
$filename=$result_explode[3]; 

// Insert the data
$query2="UPDATE `files_of_unit`
SET `file_status`=-1
WHERE `file_name`='$filename'+'.pdf'";
$results2 = mysqli_query($mysqli, $query2);

echo "$t";

?>