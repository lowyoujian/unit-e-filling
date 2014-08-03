<!DOCTYPE HTML>
<html>
<?php 
include('upload.php');
session_start();
$unitcode = $_GET['unitcodeslist'];


// Retrieve relevant unitcode details.
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
if ($mysqli->connect_error) {
	die('Connect Error (' . $mysqli->connect_errno . ') '
		. $mysqli->connect_error);
}

$stmt=$mysqli->prepare("SELECT unitname,semester,programme,hod,lectures,tutorials,quizzes,tests,practicals,assignments from unitfile where unitcode=?");
$stmt->bind_param('s',
	$unitcode);
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

			$("#divSaveChange").hide();
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

			$("#editNumFiles").click(function(){
				$(this).hide();
				$("#divSaveChange").show();
				$("#tutorial").removeAttr("readonly");
				$("#lecture").removeAttr("readonly");
				$("#quiz").removeAttr("readonly");
				$("#test").removeAttr("readonly");
				$("#practical").removeAttr("readonly");
				$("#assignment").removeAttr("readonly");
			});
		});
	</script>
</head>
<body>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">e-Unitfile</div>
			<div class="panel-body">

				<form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="unitcodes" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitcode'] ?></label>
						<div class="col-sm-3">
							<input type="text" readonly name="unitcodes" required class="form-control" id="unitcodes" value="<?php echo $unitcode?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="unitnames" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" name="unitnames" readonly class="form-control" id="unitnames" value="<?php echo $unitname?>" >
						</div>
					</div> 
					<div class="form-group">
						<label for="yearandtrimester" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
							<input type="text" readonly name="unitcodes" required class="form-control" id="unitcodes" value="Jan 2014" >
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
					</div>
					<div id="divUpload" style="visibility: none;" class="form-group">
						<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
						<div class="col-sm-6">
							<input type="file" name="file[]" id="fileToUpload" webkitdirectory="" directory="">
						</div>
						<div class="row">
							<button  name="submitFiles" type="submit" value="uploadFiles" class="btn btn-default">Submit</button>
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
	</div>
	<div   class="panel panel-default">
		<div class="panel-heading">Uploading file</div>
		<div id="uploadfilepanel" class="panel-body">
		</div>
	</div>

	<div   class="panel panel-default">
		<div class="panel-heading">Needed Files</div>

		<div id="uploadfilepanel" class="panel-body">
		</div>
	</div>
</div>
</body>
</html>
