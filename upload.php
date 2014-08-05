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
        echo $_FILES["files"]["name"][$i] . " already exists. ";
      } else {
        if (!is_dir($folder_destination)) 
// is_dir - tells whether the filename is a directory
        {
    //mkdir - tells that need to create a directory
          mkdir($folder_destination);
        }  

        $file_status="unapproved";
        $stmt=$mysqli->prepare("INSERT INTO unitfile (lecturerid,filename,semester,programme,unitcode,unitname,uploaddate,filestatus,hod,url) VAlUES(?,?,?,?,?,?,?,?,?,?) ");
        $stmt->bind_param('ssssssssss',
         $lecturerid,
         $file_name,
         $semester,
         $programme,
         $unitcode,
         $unitname,
         $upload_date,
         $file_status,
         $hod,
         $file_destination
         );
        $stmt->execute();



        move_uploaded_file($_FILES["files"]["tmp_name"][$i],
          $file_destination);


        echo "Stored in: " . "upload/" .$_POST["unitcode"] . $_POST["trimester"]."/" . $_FILES["files"]["name"][$i];
      }
    }
  }









?>