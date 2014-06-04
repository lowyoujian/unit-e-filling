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
							<input type="text" name="unitcode" required class="form-control" id="inputEmail3" placeholder="UECS 3333">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['unitname'] ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="inputEmail3" placeholder="Web Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['trimester'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="May/2014">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['programme'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="Software Engineering">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['moderator'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="ooieh@utar.my">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['quizzes'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['tests'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['labs'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label"><?php echo $upload_form_fields['assignments'] ?></label>
						<div class="col-sm-3">
							<input type="text" name="" required class="form-control" id="inputEmail3" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputFile" class="col-sm-2 control-label">File input:</label>
						<div class="col-sm-6">
							<input type="file" required name="file[]" class="form-control" id="exampleInputFile">
						</div>
						<div class="row">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
						

					</div>
					
					
				</form>
			</div>
		</div>
	</div>




	
</body>
</html>


