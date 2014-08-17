<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>
<?php
$code = $_GET['unit_code'];
?>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Number of File Setting</div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" id="form1" role="form" action="home.php" method="POST" enctype="multipart/form-data">
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
									
						<input type="hidden" name="unitcode" id="unitcode" value="<?php echo $code;?>">
						
				<div id="div-save" class="input-attr">
					<button type="submit">Save</button>
				</div>
				</form>
				


			</div>
	</div>
	

	
</body>
</html>