<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	
	<script src="script.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	
</head>
<body>
<?php include 'title_bar.php'; ?>
<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Assign Programme</div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" id="form1" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="programmeName" class="col-sm-2 control-label">Programme Name</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="programmeNames" name="programmeNames" placeholder="Software Engineering" size="35"/>	
						</div>
					</div>
					<div class="form-group">
						<label for="shortCode" class="col-sm-2 control-label">Short Code</label>
						<div class="col-sm-3">
							<input class="form-control" type="text" id="shortCodes" name="shortCodes" placeholder="SE" size="35"/>														
						</div>
					</div>
				<div id="div-save" class="input-attr">
					<button type="submit" onclick="programmeAssignValidation()">Save</button>
				</div>
				</form>


			</div>
	</div>
		<?php
		include('database_config.php');
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		
			
			$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}
if($_POST['programmeNames']!=NULL && $_POST['shortCodes']!= NULL)
{
			$sql = <<<SQL
INSERT INTO `programme` (`programme_name`, `short_code`)
VALUES (?, ?)
SQL;

			if ($stmt3 = $mysqli3->prepare($sql)) {
				$stmt3->bind_param('ss', 
					$_POST['programmeNames'],
					$_POST['shortCodes']
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
	}
	?>
</body>
</html>