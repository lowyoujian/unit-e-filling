<!DOCTYPE HTML>
<html>
<?php
session_start();
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
var_dump($unitname);
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
							<input type="text" name="" readonly required class="form-control" id="programme" value="Software Engineering" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="moderator" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" readonly name="moderator" required class="form-control" id="moderator" value="<?php echo $hod?>" >
						</div>
						<div class="row">
							<input type="button"  name="submitFiles"  value="uploadFiles" class="btn btn-default">
						</div>				

					</div>
				</form>
				<form>
					<div id="divUpload" style="visibility: none;" class="form-group">
						<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
						<div class="col-sm-6">
							<input type="file" id="files" multiple  name="files[]" id="fileToUpload">
						</div>
						<div class="row">
							<input type="button"  id="submitFiles"  value="uploadFiles" class="btn btn-default"></button>
						</div>				

					</div>
				</form>
	
				<form class="form-horizontal" id="numfiles" role="form" action="" method="POST" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">Number of Files	</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="lecture" class="col-sm-2 control-label"><?php echo $upload_form_fields['lectures'] ?></label>
								<div class="col-sm-3">
									<input type="text"  readonly="readonly" name="lecture" required class="form-control" id="lecture" value="<?php echo $lectures?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="tutorial" class="col-sm-2 control-label"><?php echo $upload_form_fields['tutorials'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="tutorial" required class="form-control" id="tutorial" value="<?php echo $tutorials?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="quiz" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="quiz" required class="form-control" id="quiz" value="<?php echo $quizzes?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="test" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="test" required class="form-control" id="test" value="<?php echo $tests?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="practical" class="col-sm-2 control-label"><?php echo $upload_form_fields['practicals'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="practical" required class="form-control" id="practical" value="<?php echo $practicals?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label for="assignment" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
								<div class="col-sm-3">
									<input type="text" readonly="readonly" name="assignment" required class="form-control" id="assignment" value="<?php echo $assignments?>" placeholder="">
								</div>

							</div>	
						</div>

					</div>
				</div>
			</form>
		</div>
		<div   class="panel panel-default">
			<div class="panel-heading">Uploading file</div>
			<div id="uploadfilepanel" class="panel-body">
			</div>
		</div>

		<div   class="panel panel-default">
			<div class="panel-heading">Needed Files</div>

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

				var_dump($neededFiles);

				?>
				<script>
					var js_neededFiles = <?php echo json_encode($neededFiles);?>;
					console.log(js_neededFiles);

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
			var btn = document.getElementById("submitFiles");
			btn.addEventListener('click', function(e) {
				var form = document.getElementById('form1');
				var files = document.getElementById("files").files;
				console.log(files);
				console.log(form);
				var fd = new FormData(form);
				console.log(fd);
				for(var x=0; x<files.length; x++){
						fd.append("files[]", files[x]);
						
					}



					

		
			
  // These extra params aren't necessary but show that you can include other data.

  $.ajax({
    url: 'upload.php',
    data: fd,
    processData: false,
    contentType: false,
    type: 'POST',
    success: function(data){
      console.log(data);
    }
  });


}, false);
</script>
</div>
</body>
</html>
