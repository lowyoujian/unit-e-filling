<?php

$input=array();
$upload_form_fields = array(
	'unitcode'  => 'Unit Code:',
	'unitname'  => 'Unit Name:',
	'trimester' => 'Trimester/Year:',
	'programme' => 'Programme:',
	'moderator' => 'Moderator:',
	'quizzes'   => 'Number of Quizzes:',
	'tests'     => 'Number of Tests:',
	'labs'      => 'Number of Labs:',
	'assignments'=> 'Number of Assignments:' 
	);

foreach($upload_form_fields as $key => $value)
{
	$input[$key] = '';
}


if($_SERVER['REQUEST_METHOD']=="POST"){

	if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Stored in: " . $_FILES["file"]["tmp_name"];
	}


	$allowedExts = array("zip");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "application/zip")
		|| ($_FILES["file"]["type"] == "application/octet-stream")
		&& ($_FILES["file"]["size"] < 500000)
		&& in_array($extension, $allowedExts))) {
		if ($_FILES["file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		} else {
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
			if (file_exists("upload/" . $_FILES["file"]["name"])) {
				echo $_FILES["file"]["name"] . " already exists. ";
			} else {
				move_uploaded_file($_FILES["file"]["tmp_name"],
					"upload/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			}
		}
	} else {
		echo "Invalid file";
	}




}


?>
