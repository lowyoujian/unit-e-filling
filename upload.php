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
	'num_lecture'     => 'Number of num_lecture:',
	'practicals'      => 'Number of Practicals:',
	'num_assignment'=> 'Number of num_assignment:' 
	);

foreach($upload_form_fields as $key => $value)
{
	$input[$key] = '';
}

if($_SERVER['REQUEST_METHOD']=="POST" ){

  
  $num_files = count($_FILES['files']['name']);  
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

   if(!( $con = new mysqli($database['ip'], $database['username'], '', $database['database_name']))){ echo "prepare failed".$mysqli2-$mysqli2->error;}
    $que = <<<SQL
INSERT INTO unitfile VALUES ( "{$_POST['user_id']}","{$processed_filename}","{$_POST['trimester']}","{$_POST['programme']}","{$_POST['unitcode']}","{$_POST['unitname']}","{$upload_date}","{$file_status}",{$_POST['moderator']},{$file_destination});
SQL;
  echo $que;
  mysql_query($que,$con);
  mysql_close($con);
    
    move_uploaded_file($_FILES["files"]["tmp_name"][$i],
      $file_destination);


    echo "Stored in: " . "upload/" .$_POST["unitcode"] . $_POST["trimester"]."/" . $_FILES["files"]["name"][$i];
  }

}









?>