<?php
date_default_timezone_set('America/Los_Angeles');


$input=array();
$upload_form_fields = array(
	'unitcode'  => 'Unit Code:',
	'unitname'  => 'Unit Name:',
	'trimester' => 'Trimester/Year:',
	'programme' => 'Programme:',
	'moderator' => 'Moderator:',
	'quizzes'   => 'Number of Quizzes:',
	'tutorials'   => 'Number of Tutorials:',
	'tests'     => 'Number of Tests:',
	'lectures'     => 'Number of Lectures:',
	'practicals'      => 'Number of Practicals:',
	'assignments'=> 'Number of Assignments:' 
	);

foreach($upload_form_fields as $key => $value)
{
	$input[$key] = '';
}

if($_SERVER['REQUEST_METHOD']=="POST" && !empty($_POST('submitFiles'))){

  $mysqli = new mysqli('localhost', 'root', '', 'team_project');
  if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
      . $mysqli->connect_error);
  }

  $num_files = count($_FILES['file']['name']); 
  $current_date = "test";
  $status = "Unknown";
  $hod = "Mr. Lim";

  for($i = 0 ; $i <$num_files; $i++){
    $dir =  "upload/" .$_GET["unitcode"] . $_GET["trimester"]."/" . $_FILES["file"]["name"][$i];
    $date = date('Y-m-d h:i:s ', time());
    var_dump($date);

    echo "Upload: " . $_FILES["file"]["name"][$i] . "<br>";
    echo "Type: " . $_FILES["file"]["type"][$i] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"][$i] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"][$i] . "<br>";
    if (file_exists("upload/" .$_GET["unitcode"] . $_GET["trimester"] . $_FILES["file"]["name"][$i])) {
      echo $_FILES["file"]["name"][$i] . " already exists. ";
    } else {
      if (!is_dir("upload/" .$_GET["unitcode"] . $_GET["trimester"]."/")) 
// is_dir - tells whether the filename is a directory
      {
    //mkdir - tells that need to create a directory
        mkdir("upload/" .$_GET['unitcode'] . $_GET['trimester']."/");
      }  


      $stmt=$mysqli->prepare("INSERT INTO unitfile VAlUES(?,?,?,?,?,?,?,?) ");
      $stmt->bind_param('ssssssss',
       $_FILES['file']['name'][$i],
       $_GET['unitcode'],
       $_GET['trimester'],
       $_GET['unitcode'],
       $date,
       $status,
       $hod,
       $dir
       );
      $stmt->execute();



      move_uploaded_file($_FILES["file"]["tmp_name"][$i],
        "upload/" .$_GET["unitcode"] . $_GET["trimester"]."/" . $_FILES["file"]["name"][$i]);

      
      echo "Stored in: " . "upload/" .$_GET["unitcode"] . $_GET["trimester"]."/" . $_FILES["file"]["name"][$i];
    }
  }
}








?>