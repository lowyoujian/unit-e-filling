<!DOCTYPE HTML>
<html>
<?php
session_start();
if(isset($_POST['unit_code'])){
$_SESSION['unit_code']=$_POST['unit_code'];
}
    include('database_config.php');
    $getDate = new Upload();
    $getDate->getCurrentTrimester();
    
?>
<?php
 $mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
$unit_code = $_SESSION['unit_code'];
$uploadHandler = new Upload();
$uploadHandler->getCurrentTrimester();
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
if($_SERVER['REQUEST_METHOD']=="POST"){
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
      $mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

    }

}





// Retrieve relevant unitcode details.

$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
$user_id=$_SESSION['user_id'];
$stmt=$mysqli->prepare("SELECT unit_id,trimester,num_lecture,num_tutorial,num_quiz,num_test,num_practical,num_assignment FROM lecturer_and_unit_files WHERE unit_code=? AND trimester=? AND user_id=?");
$stmt->bind_param('sss',
    $unit_code,
    $uploadHandler->date,
    $user_id);
$stmt->execute();
$stmt->bind_result($unit_id,$trimester,$num_lecture,$num_tutorial,$num_quiz,$num_test,$num_practical,$num_assignment);
$stmt->fetch();
$date=$uploadHandler->date;
if($num_lecture == null && $num_tutorial == null){
header("Location:set_file.php?unit_code={$_POST['unit_code']}");
}


$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);

 $stmt2=$mysqli->prepare("SELECT unit_name FROM unit WHERE unit_code =?"); 
    $stmt2->bind_param('s',
    $unit_code);
    $stmt2->execute();

$stmt2->bind_result($unit_name);
$stmt2->fetch();

$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
$stmt3= $mysqli->prepare("SELECT programme_name from programme WHERE id IN(SELECT programme_id from unit where unit_code = ?) ");
   $stmt3->bind_param('s',
    $unit_code);
    $stmt3->execute();
$stmt3->bind_result($programme_name);
$stmt3->fetch();

$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
$stmt4= $mysqli->prepare("SELECT name from user WHERE user_id IN(SELECT user_id from mod_and_unit where unit_code = ? AND trimester=? ) ");
   $stmt4->bind_param('ss',
    $unit_code,
    $trimester);
    $stmt4->execute();
$stmt4->bind_result($mod_name);
$stmt4->fetch();

$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
$stmt5= $mysqli->prepare("SELECT file_name, datetime_uploaded, file_status from ( SELECT file_name, max(datetime_uploaded),file_status, datetime_uploaded from files_of_unit where unit_id =? AND user_id=? AND trimester = ? group by file_name DESC) as name ORDER BY file_name");
   $stmt5->bind_param('sss',
    $unit_id,
    $user_id,
    $trimester);
    $stmt5->execute();
$stmt5->bind_result($file_name,$datetime_uploaded,$file_status);
$file_name_array=array();
$datetime_uploaded_array=array();
$file_status_array=array();

$i=0;
while($stmt5->fetch()){
    $i++;
    $file_name_array[$i]=$file_name;
    $datetime_uploaded_array[$i]=$datetime_uploaded;
    $file_status_array[$i]=$file_status;

}
?>
<script>
var js_datetime_uploaded_array = <?php echo json_encode($datetime_uploaded_array) ;?>;

var js_file_name_array =<?php echo json_encode($file_name_array) ;?>;

var js_file_status_array =<?php echo json_encode($file_status_array);?>;

</script>

<?php include('php_files/generatefilelist.php'); ?>




</script>



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
	<table>
		<tr>
			<td align='center'><a href='unitcodelist.php' class="btn btn-default">Home</a></td>			
			<td align='center'><a href="logout.php" class="btn btn-default">Logout</a></td>
		</tr>
	</table>
	</div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">e-Unitfile</div>
            <div class="panel-body">
    
                <form class="form-horizontal" id="form1" role="form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="unitcodes" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitcode'] ?></label>
                        <div class="col-sm-3">
                            <input type="text" readonly name="unit_code" required class="form-control" id="unitcodes" value="<?php echo $unit_code?>" >

                            <input type="text" style="display:none;" name="unitcode" required class="form-control" id="unitcodes" value="<?php echo $unit_code?>" >
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
                            
                        </div>    <div class = "extra info for ajax">
                    <input type="text" readonly name="unit_id" style="display:none;" required class="form-control"  value="<?php echo $unit_id?>" >
                    <input type="text" readonly name="date" style="display:none;" required class="form-control"  value="<?php echo $uploadHandler->date?>" >
                    <input type="text" readonly name="user_id" style="display:none;" required class="form-control"  value="<?php echo $user_id?>" >
                    <input type="text" readonly name="trimester" style="display:none;" required class="form-control"  value="<?php echo $trimester?>" >
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
                <progress id="progress_bar" value="0" max="100"></progress>
                <div style="margin:20px" id="addedFile"></div>
            </div>
        </div>


        <?php
        $neededFiles= array();
        $file_status= array();

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
var js_neededFiles_with_unitcode = new Array('');
for(var i=0;i<js_neededFiles.length;i++){
    
    js_neededFiles_with_unitcode[i]= js_neededFiles[i];
    js_neededFiles_with_unitcode[i] = "<?php echo $unit_code."_"; echo $date."_";?>"+js_neededFiles_with_unitcode[i];
}
 $("#files_table").append('<tr id=Title><td>File</td><td>Exist On Server</td><td>Exists in your local folder</td><td>Status</td><td>Upload</td></tr>');
for(var i=0; i<js_neededFiles.length; i++){
    $("#files_table").append('<tr id='+'tr'+i+'>'+js_neededFiles[i]);
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td0'+'>'+js_neededFiles[i]+'</span></td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td2'+'>'+'<span style="color:black;">Not Found</span>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td3'+'>'+"Not Found"+'</span></td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td1'+'>'+"Not Available"+'</td>');
    $("#"+"tr"+i).append('<td id='+'tr'+i+'td4'+'>'+'<input type="button" style="visibility:hidden;" disabled="true" value="Add to Upload"/>'+'</td>');
    $("#files_table").append('</tr>');
    
}


var count = Object.keys(js_file_name_array).length;
for(var i=0; i<js_neededFiles.length; i++){

    for(var x=1; x<=count; x++){
        if(js_file_name_array[x]==js_neededFiles_with_unitcode[i]){
             $("#"+"tr"+i+"td2").html("<span style='color:green;font-size:18px;font-weight:bold;'>Found</span>");
             if(js_file_status_array[x]=='0')
             {
                $("#"+"tr"+i+"td1").html("Not approved or rejected");
             }
             else if(js_file_status_array[x]=='1')
             {
                $("#"+"tr"+i+"td1").html("Approved");
             }
             else if(js_file_status_array[x]=='-1')
             {
                $("#"+"tr"+i+"td1").html("Rejected");
             }
             
            }
        
    }

}

$( document ).ready(function() {
  var form = document.getElementById('form1');
  var fd = new FormData(form);
  var added_file_count = 0;
var uploadbtn = document.getElementById("submitFiles");
uploadbtn.addEventListener('click', function(e) {
    $("#submitFiles").prop('value',"uploading Files");
  
    var files = document.getElementById("files").files;  
    $.ajax({
      
    url: 'upload.php',
    data: fd,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(data){
    $("#submitFiles").removeAttr('class');
    $("#progress_bar").prop('value','100');
    $("#submitFiles").attr('class','btn btn-success');
    $("#submitFiles").prop('value','Successfully uploaded');
    setTimeout(
  function() 
  {
     window.location.reload(true);
  }, 500);
   
}
}
)
})

$("#files").change(function(){
    var foundfiles=0;
    var form = document.getElementById('form1');
    var files = document.getElementById("files").files;
    
    
    for(var x=0; x<files.length; x++){
        if(inArray(files[x].name,js_neededFiles)){
            foundfiles++; 
           }
        
                // change from red to green if expected file in folder is found
        for(var i =0; i<js_neededFiles.length; i++){
            if($("#"+'tr'+i+'td0').text()==files[x].name){
                $("#"+"tr"+i+"td3").html("<span style='color:green;font-size:18px'>Found</span>");
                 $("#"+"tr"+i+"td4").html('<input id="'+i+'" type="button" class="addToUpload" value="Add to Upload"/>');

        }
    }

}

$(".addToUpload").click(function(){
    $(this).prop("value","ADDED");
    $(this).prop("disabled","true");
    var id = this.id;
    var file1name = $("#"+"tr"+id+"td0").text();
    for(var x=0; x<files.length; x++){
        if(file1name==files[x].name){
            fd.append("files[]", files[x]);
        added_file_count++;    }
    $('#addedFile').html('<p>Total added files for upload is ' +added_file_count);
    if(added_file_count>0){
    $("#submitFiles").removeAttr('disabled');
$("#submitFiles").attr('class','btn btn-normal')
}


}})

$("#filesMatched").append(foundfiles+" out of "+js_neededFiles.length+" files found.<br>");





});












})
</script>
</body>
</html>
