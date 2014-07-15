<?php
$server="localhost";
  $user="root";
  $pass="";
  $database="team_project";
  
$t = $_POST['t'];

$link = mysql_connect($server,$user,$pass);
if (!$link) {
die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db($database, $link);

// Insert the data
$query2="UPDATE unitFile
SET fileStatus=-1
WHERE fileName='$t'";
$results2 = mysql_query($query2, $link);
echo "$t";

?>