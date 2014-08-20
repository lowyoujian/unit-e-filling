<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	
	<script src="script.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<?php
	var_dump($_POST);
	include('database_config.php');
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt=$mysqli->prepare("SELECT ID, unit_code, unit_name FROM unit");
	$stmt->execute();
	$stmt->bind_result($unit_id, $unit_code, $unit_name);
	?>	
</head>
<body>
<?php include 'title_bar.php'; ?>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Assign Lecturer</div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" id="form1" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="lecturerid" class="col-sm-2 control-label">Lecturer ID</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="lecturerId" name="lecturerId" placeholder="10101010" size="35"/>															
						</div>
					</div>
					
					<div class="form-group">
						<label for="unit" class="col-sm-2 control-label">Unit Code</label>
						<div class="col-sm-5">
						<select name="unitlist">
						<?php 
						while($stmt->fetch()){
							if($unit_id!='')
								echo "<option value='$unit_id'>$unit_code $unit_name</option>";	 
						}	
						?>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label for="trimester" class="col-sm-2 control-label">Trimester</label>
						<div class="col-sm-5">
						<select name="trimesterList" id="trimesterList">
						<option value='Jan/2014'>Jan/2014</option>
						<option value='May/2014'>May/2014</option>
						<option value='Oct/2014'>Oct/2014</option>
						</select>
						</div>
					</div>
					
				<div id="div-save" class="input-attr">
					<button type="submit" onclick="lecturerAssignValidation()">Save</button>
				</div>
				</form>


			</div>
	</div>
		
		<?php
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		
		$mysqli2 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli2->connect_error) {
		die('Connect Error (' . $mysqli2->connect_errno . ') '
			. $mysqli2->connect_error);
	}
	$stmt2=$mysqli2->prepare("SELECT * FROM user WHERE user_id = ?");
	$stmt2->bind_param('s',		
			$_POST['lecturerId']);
	$stmt2->execute();
	if($stmt2 != NULL){
	
			$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}
	
	
		
		$sql = <<<SQL
INSERT INTO `lecturer_and_unit_files` (`user_id`, `unit_id`, `unit_code`, `trimester`)
VALUES (?, ?, ?, ?)
SQL;

			if ($stmt3 = $mysqli3->prepare($sql)) {
				$stmt3->bind_param('sdss', 
					$_POST['lecturerId'],
					$_POST['unitlist'],
					$unit_code,
					$_POST['trimesterList']
				);
				
				$stmt3->execute();
				$stmt3->close();
				
				
				exit;
			}
			else {
				die('Database Error (' . $mysqli3->errno . ') '
					. $mysqli3->error);	
			}			
		}
		echo "ERROR" ;
	}
	
	?>
</body>
</html>