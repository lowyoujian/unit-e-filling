<!DOCTYPE HTML>
<html>
<?php
	
	
	include('database_config.php');
	$getDate = new Upload();
	$getDate->getCurrentTrimester();
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
		if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}




		}
	
?>
<?php
session_start();
$unit_code = $_POST['unit_code'];
$uploadHandler = new Upload();
$uploadHandler->getCurrentTrimester();
if($_SERVER['REQUEST_METHOD']=="post"){
    $query = <<<SQL
    SELECT id, unit_code, unit_name FROM unit WHERE id IN(SELECT unit_id FROM lecturer_and_unit_files WHERE user_id = {$_SESSION['user_id']});
SQL;
    
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id,$unit_code,$unit_name);
}
include('database_config.php');

class Upload {


    function set_user_id($user_id){
        $this->$user_id = $_SESSION['user_id'];
    }

    function getCurrentTrimester(){

        $date=date('M');

        if($date=="Oct"
            ||"Nov"
            ||"Dec"
            )
            {$this->date="Oct".date('Y');}

        if($date=="Jan"
            ||"Feb"
            ||"Mac"
            ||"Apr"
            ||"May"
            )
            {$this->date="Jan".date('Y');}

        if($date=="Jun"
            ||"Jul"
            ||"Aug"
            ||"Sept"
            )
            {$this->date="May".date('Y');}

        
    }

    function connect_db(){
      $mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

    }

}


include('upload.php');



// Retrieve relevant unitcode details.

$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
$user_id=$_SESSION['user_id'];
$stmt=$mysqli->prepare("SELECT unit_id,trimester,num_lecture,num_tutorial,num_quiz,num_test,num_practical,num_assignment FROM lecturer_and_unit_files WHERE unit_code=? AND trimester=? AND user_id=?");
$stmt->bind_param('sss',
    $unit_code,
    $uploadHandler->date,
    $user_id);
$stmt->execute();
$stmt->bind_result($unit_id,$trimester,$num_lecture,$num_tutorial,$num_quiz,$num_test,$num_practical,$num_assignment);
$stmt->fetch();
if($num_lecture == NULL){
header("Location:set_file.php?unit_code={$_POST['unit_code']}");
}


$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);

 $stmt2=$mysqli->prepare("SELECT unit_name FROM unit WHERE unit_code =?"); 
    $stmt2->bind_param('s',
    $unit_code);
    $stmt2->execute();

$stmt2->bind_result($unit_name);
$stmt2->fetch();

$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
$stmt3= $mysqli->prepare("SELECT programme_name from programme WHERE id IN(SELECT programme_id from unit where unit_code = ?) ");
   $stmt3->bind_param('s',
    $unit_code);
    $stmt3->execute();
$stmt3->bind_result($programme_name);
$stmt3->fetch();

$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
$stmt4= $mysqli->prepare("SELECT name from user WHERE user_id IN(SELECT user_id from mod_and_unit where unit_code = ? AND trimester=? ) ");
   $stmt4->bind_param('ss',
    $unit_code,
    $trimester);
    $stmt4->execute();
$stmt4->bind_result($mod_name);
$stmt4->fetch();


include('php_files/generatefilelist.php');


?>



<head>
    <title>Unit e-Filling</title>   
   
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="jquery-2.1.1.js"></script>
    <script>
        $(document).ready(function(){

            $("#btnSaveChange").click(function(){
                $("#tutorial").prop("readonly",true);
                $("#lecture").prop("readonly",true);
                $("#quiz").prop("readonly",true);
                $("#test").prop("readonly",true);
                $("#practical").prop("readonly",true);
                $("#assignment").prop("readonly",true);
                $(this).prop("class",'btn btn-success');
                $("#btnSaveChange").text("Success");
            })  ;
});
</script>
</head>
<body>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">e-Unitfile</div>
            <div class="panel-body">

                <form class="form-horizontal" id="form1" role="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="unitcodes" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitcode'] ?></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="unitcode" required class="form-control" id="unitcodes" value="<?php echo $unit_code?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unitnames" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
                        <div class="col-sm-5">
                            <input type="text" name="unitname" readonly class="form-control" id="unitnames" value="<?php echo $unit_name?>" >
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="yearandtrimester" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="trimester" required class="form-control" id="trimester" value="<?php echo $trimester?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="programme" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
                        <div class="col-sm-3">
                            <input type="text" name="programme" readonly required class="form-control" id="programme" value="<?php echo $programme_name?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="moderator" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="moderator" required class="form-control" id="moderator" value="<?php echo $mod_name?>" >
                        </div>
                        <div class="row">
                            
                        </div>              

                    </div>
                </form>
                <form>
                    <div id="divUpload" style="visibility: none;" class="form-group">
                        <label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
                        <div class="col-sm-6">
                            <input type="file" id="files" multiple name="files[]" webkitdirectory="" directory="">
                        </div>


                    </div>
                </form>


            </div>
        </div>
        <div  class="panel panel-default">
            <div class="panel-heading">Uploading file</div>
            <div id="uploadfilepanels" style="display: inline-block; float:left;" >
            <table id="files_table" class="table" border='1'> </table>
            <div id="uploadfilepanelscheckbox" style="display: inline-block; float:left;">

            </div>
            <div id="uploadfilepanel" style="margin-left:20px">
            </div>
            <div class="row">
                <div style="margin:20px" id="filesMatched"></div>
                <input style="margin-left:30px" type="button"  id="submitFiles" disabled="disabled" value="UploadFiles" class="btn btn-hidden"></button>
                <div style="margin:20px" id="filesMatched"></div>
            </div>
        </div>


        <?php
        $neededFiles= array();
        $file=fopen("upload/$unit_code/$trimester/$unit_code.txt",'r');
        while(!feof($file))
            {    $str=fgets($file);
        $str = str_replace(array( "\n", "\t", "\r"), '', $str);
        array_push($neededFiles,$str);
    }
fclose($file);


?>
<script>
    var js_neededFiles = <?php echo json_encode($neededFiles);?>;


</script>
<div id="uploadfilepanel" class="panel-body">
</div>
</div>
</div>
<script>
    function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
}
return false;
}
 $("#files_table").append('<tr id=Title><td>File</td><td>Exist</td><td>Exists</td><td>Status</td><td>Upload</td></tr>');
for(var i=0; i<js_neededFiles.length; i++){
    $("#files_table").append('<tr id='+'tr'+i+'>'+js_neededFiles[i]);
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td0'+'>'+js_neededFiles[i]+'</span></td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td2'+'>'+'<img id='+'checkbox'+i+' width="12px"  src="images/cross.jpg"  /></td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td3'+'>'+"Not Found"+'</span></td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td1'+'>'+"Not Available"+'</td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td1'+'>'+'<input type="button" style="visibility:hidden;" disabled="true" value="Add to Upload"/>'+'</td>');

    $("#files_table").append('</tr>');
    
}


$("#files").change(function(){
    var foundfiles=0;
    var form = document.getElementById('form1');
    var files = document.getElementById("files").files;
    console.log(files);
    console.log(form);
    var fd = new FormData(form);
    for(var x=0; x<files.length; x++){
        if(inArray(files[x].name,js_neededFiles)){
            fd.append("files[]", files[x]);
        foundfiles++;
                // change from red to green if expected file in folder is found
        for(var i =0; i<js_neededFiles.length; i++){
            if($("#"+'tr'+i+'td0').text()==files[x].name){
                $("#"+'filelist'+i).css("color","green");
                $("#"+'filelist'+i).css("font-weight","bold");
                $("#"+'checkbox'+i).prop("src","images/tick.jpg");

        }
    }
}
}
$("#filesMatched").append(foundfiles+" out of "+js_neededFiles.length+" files found.");
if(foundfiles>0){
    $("#submitFiles").removeAttr('disabled');
$("#submitFiles").attr('class','btn btn-normal')
}

});

var uploadbtn = document.getElementById("submitFiles");
uploadbtn.addEventListener('click', function(e) {

    var form = document.getElementById('form1');
    var files = document.getElementById("files").files;
    console.log(files);
    console.log(form);
    var fd = new FormData(form);
    console.log(fd);
    for(var x=0; x<files.length; x++){
        if(inArray(files[x].name,js_neededFiles)){
            fd.append("files[]", files[x]);
    }
}


$.ajax({
    url: 'upload.php',
    data: fd,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(data){
    $("#submitFiles").removeAttr('class');
    $("#submitFiles").attr('class','btn btn-success');
    $("#submitFiles").prop('value','Success');
    console.log(data);
}
}
)})


</script>
</body>
</html>
