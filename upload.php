<?php
include('database_config.php');
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

if($_SERVER['REQUEST_METHOD']=="POST" ){

  $mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
  if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
      . $mysqli->connect_error);
  }
  
  $num_files = count($_FILES['files']['name']);  
  var_dump($num_files);
  $upload_date=date("Y:M:D:H:M:s");
  for($i = 0 ; $i <$num_files; $i++){
    $processed_filename=$_POST["unitcode"]."_" .$_POST["trimester"]."_". $_FILES["files"]["name"][$i];
    $dir =  "upload/" .$_POST["unitcode"] . $_POST["trimester"]."/" . $_FILES["files"]["name"][$i];
    $date = date('Y-m-d h:i:s ', time());

    //change these two lines to fit your server/storage
    $file_destination="upload/" .$_POST["unitcode"] ."/".$_POST["trimester"]."/" .$processed_filename;
    $folder_destination="upload/" .$_POST["unitcode"] ."/".$_POST["trimester"];
    echo "Upload: " . $_FILES["files"]["name"][$i] . "<br>";
    echo "Type: " . $_FILES["files"]["type"][$i] . "<br>";
    echo "Size: " . ($_FILES["files"]["size"][$i] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["files"]["tmp_name"][$i] . "<br>";
    if (file_exists($file_destination)) {
      unlink($file_destination);
    }
    if (!is_dir($folder_destination)) 
// is_dir - tells whether the filename is a directory
    {
    //mkdir - tells that need to create a directory
      mkdir($folder_destination);
    } 

      $file_status="unapproved";

  var_dump($_POST['lecturerid']);
  var_dump($_POST['trimester']);
  var_dump($_POST['programme']);
  var_dump($_POST['unitcode']);
  var_dump($upload_date);
  var_dump($file_status);
  var_dump($_POST['unitname']);
  var_dump($_POST['moderator']);
  var_dump($file_destination);

    $mysqli2 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
    $stmt2=$mysqli2->prepare("INSERT INTO `unitfile` (`lecturerid`,`filename`,`semester`,`programme`,`unitcode`,`unitname`,`uploaddate`,`filestatus`,`hod`,`url`) VALUES(?,?,?,?,?,?,?,?,?,?) ");
    $stmt2->bind_param('ssssssssss',
     $_POST['lecturerid'],
     $file_name,
     $_POST['trimester'],
     $_POST['programme'],
     $_POST['unitcode'],
     $_POST['unitname'],
     $upload_date,
     $file_status,
     $_POST['moderator'],
     $file_destination
     );
    var_dump($stmt2);
    
    $stmt2->execute();
    move_uploaded_file($_FILES["files"]["tmp_name"][$i],
      $file_destination);


    echo "Stored in: " . "upload/" .$_POST["unitcode"] . $_POST["trimester"]."/" . $_FILES["files"]["name"][$i];
  }

}









?>