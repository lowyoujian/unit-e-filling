<?php

	
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
  if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
      . $mysqli->connect_error);
  }



?>