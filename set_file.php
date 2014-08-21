<!DOCTYPE HTML>
<html>
<?php include('database_config.php');
session_start();
if(isset($_GET['unit_code'])){
$_SESSION['code']=$_GET['unit_code'];
}
?>
<?php
$code = $_SESSION['code'];

		if($_SERVER['REQUEST_METHOD'] == "POST") {
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

$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
		if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}
			$sql = <<<SQL
			UPDATE `lecturer_and_unit_files`
SET `num_lecture`={$_POST['numOfLectures']}, `num_tutorial`= {$_POST['numOfTutorials']}, `num_practical`={$_POST['numOfPracticals']}, `num_assignment`={$_POST['numOfAssignments']}, `num_test`={$_POST['numOfTests']}, `num_quiz`={$_POST['numOfQuizes']}
WHERE `unit_code`='$code' AND `trimester`= '$date';
SQL;

mysqli_query($mysqli3, $sql);

header("location:home.php");

}

	?>
<head>
	<title>Unit e-Filling</title>	
	<script src="script.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>
<?php

?>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Number of File Setting for Unit <?php echo $code?></div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" action="<?php echo $_SERVER['PHP_SELF']?>" id="form1" role="form" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="numOfLecture" class="col-sm-2 control-label">Number of Lecture </label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfLectures" name="numOfLectures" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfTutorial" class="col-sm-2 control-label">Number of Tutorial</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfTutorials" name="numOfTutorials"  size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfPractical" class="col-sm-2 control-label">Number of Practical</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfPracticals" name="numOfPracticals"  size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfAssignment" class="col-sm-2 control-label">Number of Assignment</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfAssignments" name="numOfAssignments"  size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfTest" class="col-sm-2 control-label">Number of Test</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfTests" name="numOfTests"  size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="numOfQuiz" class="col-sm-2 control-label">Number of Quiz</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="numOfQuizes" name="numOfQuizes" size="35"/>							
						</div>
					</div>
									
						<input type="hidden" name="unitcode" id="unitcode" value="<?php echo $code;?>">
						
				<div id="div-save" class="input-attr">
					<button type="submit" onclick="setFileNumValidation()">Save</button>
				</div>
				</form>
				


			</div>
	</div>

	

	
</body>
</html>