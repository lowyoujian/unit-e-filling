<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	
	<script src="script.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<?php
	include('database_config.php');
	$date=date('Y');
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
						<option value='Jan2014'>Jan<?php echo $date ?></option>
						<option value='May2014'>May<?php echo $date ?></option>
						<option value='Oct2014'>Oct<?php echo $date ?></option>
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
	
		$mysqli4 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli4->connect_error) {
		die('Connect Error (' . $mysqli2->connect_errno . ') '
			. $mysqli4->connect_error);
	}
	$stmt4=$mysqli4->prepare("SELECT unit_code FROM unit WHERE id = ?");
	$stmt4->bind_param('s',		
			$_POST['unitlist']);
	$stmt4->execute();
	$stmt4->bind_result($unitc);
	$stmt4->fetch();	
	
	if($stmt2 != NULL && $stmt4 != NULL){
	
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
					$unitc,
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
