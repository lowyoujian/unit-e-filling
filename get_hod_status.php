<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_errno . ') '
		. $mysqli->connect_error);
}
	// Determine whether lecturer is also a hod		
$stmt=$mysqli->prepare("SELECT is_hod from lecturer where lecturerid=?");
$stmt->bind_param('s',
	$_SESSION['lecturerid']
	);
$stmt->execute();
$stmt->bind_result($hod);
$stmt->fetch();
	echo json_encode($hod);



?>