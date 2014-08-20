<?php
include('database_config.php');
$input=array();

var_dump($_SERVER['REQUEST_METHOD']);

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
    $date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));
    $que = <<<SQL
    INSERT INTO files_of_unit(user_id, datetime_uploaded, file_status, location, unit_id, file_name, trimester) VALUES ( {$_POST['user_id']},"{$date}",0,"{$folder_destination}",{$_POST['unit_id']},"{$processed_filename}","{$_POST['trimester']}");
SQL;
    echo $que;

    $mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
    $stmt5=$mysqli->prepare($que); 
    $stmt5->execute();

move_uploaded_file($_FILES["files"]["tmp_name"][$i],
  $file_destination);


echo "Stored in: " . "upload/" .$_POST["unitcode"] . $_POST["trimester"]."/" . $_FILES["files"]["name"][$i];
}

}









?>