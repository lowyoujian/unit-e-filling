<?php
include('database_config.php');
	session_start();
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
			
// {t:str} value from linkfile.php
$t = $_POST['t'];


// Insert the data
$query2="UPDATE `files_of_unit`
SET `file_status`=1
WHERE `file_name`='$t'";


$results2 = mysqli_query($mysqli, $query2);


?>
