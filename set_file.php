<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>
<?php
$code = $_GET['unitcode'];
?>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Number of File Setting</div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" id="form1" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="numOfLecture" class="col-sm-2 control-label">Number of Lecture</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfLectures" name="numOfLectures" placeholder="1" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfTutorial" class="col-sm-2 control-label">Number of Tutorial</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfTutorials" name="numOfTutorials" placeholder="1" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfPractical" class="col-sm-2 control-label">Number of Lecture</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfPracticals" name="numOfPracticals" placeholder="1" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfAssignment" class="col-sm-2 control-label">Number of Lecture</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfAssignments" name="numOfAssignments" placeholder="1" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfTest" class="col-sm-2 control-label">Number of Lecture</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfTests" name="numOfTests" placeholder="1" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfQuiz" class="col-sm-2 control-label">Number of Lecture</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfQuizes" name="numOfQuizes" placeholder="1" size="35"/>							
						</div>
					</div>
									
						<input type="hidden" name="unitid" id="unitid" value="<?php echo $code;?>">
						
				<div id="div-save" class="input-attr">
					<button type="submit">Save</button>
				</div>
				</form>


			</div>
	</div>
	
	<?php
	$lecture=$_POST['numOfLectures'];
	$tutorial=$_POST['numOfTutorials'];
	$practical=$_POST['numOfPracticals'];
	$assignment=$_POST['numOfAssignments'];
	$test=$_POST['numOfTests'];
	$quiz=$_POST['numOfQuizes'];
	$code2 = $_POST['unitid'];
	include('database_config.php');
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
		if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}

			$sql = <<<SQL
			UPDATE `lecturer_and_unit_files`
SET `num_lecture`=$lecture, `num_tutorial`=$tutorial, `num_practical`=$practical, `num_assignment`=$assignment, `num_test`=$test, `num_quiz`=$quiz
WHERE `unit_id`=$code2;
SQL;

$results = mysqli_query($mysqli3, $sql);

		}
		
	?>
	
</body>
</html>