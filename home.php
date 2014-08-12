<!DOCTYPE HTML>
<html>
<?php
session_start();
// error here
if($_SERVER['REQUEST_METHOD']=="posts"){
		$query = <<<SQL
	SELECT id, unit_code, unit_name FROM unit WHERE id IN(SELECT unit_id FROM lecturer_and_unit_files WHERE user_id = {$_SESSION['user_id']});
SQL;
	
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$stmt->bind_result($id,$unit_code,$unit_name);
}
include('database_config.php');
$date=date('M');

if($date=="Oct"
	||"Nov"
	||"Dec"
	)
	{$date="Oct".date('Y');}

if($date=="Jan"
	||"Feb"
	||"Mac"
	||"Apr"
	||"May"
	)
	{$date="Jan".date('Y');}

if($date=="Jun"
	||"Jul"
	||"Aug"
	||"Sept"
	)
	{$date="May".date('Y');}


include('upload.php');
$unitcode = $_GET['unitcodeslist'];


// Retrieve relevant unitcode details.

$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
$lecturerid=$_SESSION['lecturerid'];
$stmt=$mysqli->prepare("SELECT unitname,semester,programme,hod,lectures,tutorials,quizzes,tests,practicals,assignments FROM unitfile WHERE unitcode=? AND semester=? AND lecturerid=?");
$stmt->bind_param('sss',
	$unitcode,
	$date,
	$lecturerid);
$stmt->execute();
$stmt->bind_result($unitname,$semester,$programme,$hod,$lectures,$tutorials,$quizzes,$tests,$practicals,$assignments);
$stmt->fetch();
include('generatefilelist.php');


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
			})	;
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
							<input type="text" name="lecturerid" value="<?php echo $_SESSION['lecturerid'];?>" style="display:none;"/>
							<input type="text" readonly name="unitcode" required class="form-control" id="unitcodes" value="<?php echo $unitcode?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="unitnames" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" name="unitname" readonly class="form-control" id="unitnames" value="<?php echo $unitname?>" >
						</div>
					</div> 
					<div class="form-group">
						<label for="yearandtrimester" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
							<input type="text" readonly name="trimester" required class="form-control" id="trimester" value="<?php echo $date?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="programme" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="programme" readonly required class="form-control" id="programme" value="Software Engineering" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="moderator" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" readonly name="moderator" required class="form-control" id="moderator" value="<?php echo $hod?>" >
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
		<div id="uploadfilepanels" class="panel-body">
			
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
	$file=fopen("upload/UECS2094//$semester/$unitcode.txt",'r');
	while(!feof($file))
		{	 $str=fgets($file);
			$str = str_replace(array( "\n", "\t", "\r"), '', $str);
			array_push($neededFiles,$str);
		}
		foreach($neededFiles as $key=>$value)
		{
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

	for(var i=0; i<js_neededFiles.length; i++){
		$("#uploadfilepanel").append('<span id='+'filelist'+i+' style="color:red">'+js_neededFiles[i]+'</span><br>');

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
					if($("#"+'filelist'+i).text()==files[x].name){
						$("#"+'filelist'+i).css("color","green");
						$("#"+'filelist'+i).css("font-weight","bold");
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
