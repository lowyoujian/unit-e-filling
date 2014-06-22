<!DOCTYPE HTML>
<html>

<?php 
include('upload.php');
?>

<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">e-Unitfile</div>
			<div class="panel-body">

				<form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="unitcode" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitcode'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="unitcode" required class="form-control" id="inputEmail3" value="UECS 3333" placeholder="UECS 3333">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="inputEmail3" value="Web Engineering" placeholder="Web Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="May/2014" placeholder="May/2014">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="Software Engineering" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="ooieh@utar.my" placeholder="ooieh@utar.my">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['lectures'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="1" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="2" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['practicals'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" value="4" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
						<div class="col-sm-6">
							<input type="file" required name="file" class="form-control" id="exampleInputFile">
						</div>
						<div class="row">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
						
						
											
						<?php 
for ($x=1; $x<=$_POST["quiz"]; $x++) {
  echo $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "7-quiz\quiz". "$x<br>";
} 
?>
<?php 
for ($x=1; $x<=$_POST["test"]; $x++) {
  echo $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "8-test\\test". "$x<br>";
} 
?>
<?php 
for ($x=1; $x<=$_POST["lab"]; $x++) {
  echo $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "9-lab\lab". "$x<br>";
} 
?>
<?php 
for ($x=1; $x<=$_POST["assignment"]; $x++) {
  echo $_POST["unitcodes"]. " ".$_POST["unitnames"]. "\\". "10-assignment\assignment". "$x<br>";
} 
?>
						

					</div>
					
					
				</form>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">Uploaded file</div>
			<div class="panel-body">
				


			</div>
		</div>





	</body>
	</html>


