<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<?php
	include('database_config.php');
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt=$mysqli->prepare("SELECT ID, department_name FROM department");
	$stmt->execute();
	$stmt->bind_result($department_id,$department_name);
	?>	

	
</head>
<body>
<?php include 'title_bar.php'; ?>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Assign Unit</div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" id="form1" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="unitcodes" class="col-sm-2 control-label">Unit Code</label>
						<div class="col-sm-3">
							<input type="text" id="unitCodes" name="unitCodes" placeholder="UECS 2014" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="unitnames" class="col-sm-2 control-label">Unit Name</label>
						<div class="col-sm-5">
							<input type="text" id="unitNames" name="unitNames" placeholder="Software Project Management" size="35"/>	
						</div>
					</div>
					
					<div class="form-group">
						<label for="department" class="col-sm-2 control-label">Department</label>
						<div class="col-sm-5">
						<select name="departmentlist">
						<?php 
						while($stmt->fetch()){
							if($department_id!='')
								echo "<option value='$department_id'>$department_name</option>";	 
						}	
						?>
						</select>
						</div>
					</div>
					<?php
	$mysqli2 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli2->connect_error) {
		die('Connect Error (' . $mysqli2->connect_errno . ') '
			. $mysqli2->connect_error);
	}
	$stmt2=$mysqli2->prepare("SELECT ID, programme_name FROM programme");
	$stmt2->execute();
	$stmt2->bind_result($programme_id,$programme_name);
	?>
					
					<div class="form-group">
					<label for="programme" class="col-sm-2 control-label">Programme</label>
						<div class="col-sm-5">
						<select name="programmelist">
						<?php 
						while($stmt2->fetch()){
							if($programme_id!='')
								echo "<option value='$programme_id'>$programme_name</option>";	 
						}	
						?>
						</select>
						</div>
					</div>
					
				<div id="div-save" class="input-attr">
					<button type="submit">Save</button>
				</div>
				</form>


			</div>
	</div>
		<?php
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		
			
			$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}

			$sql = <<<SQL
INSERT INTO `unit` (`unit_code`, `unit_name`, `programme_id`, `department_id`)
VALUES (?, ?, ?, ?)
SQL;

			if ($stmt3 = $mysqli3->prepare($sql)) {
				$stmt3->bind_param('ssdd', 
					$_POST['unitCodes'],
					$_POST['unitNames'],
					$programme_id,
					$department_id
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
	?>
</body>
</html>