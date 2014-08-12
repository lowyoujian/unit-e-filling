
<html>
<script type="text/javascript" src="jquery-2.1.1.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<head>
	<?php
	include('database_config.php');
	session_start();
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	var_dump($_SESSION['user_id']);
	$query = <<<SQL
	SELECT id, unit_code, unit_name FROM unit WHERE id IN(SELECT unit_id FROM lecturer_and_unit_files WHERE user_id = {$_SESSION['user_id']});
SQL;
	
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$stmt->bind_result($id,$unit_code,$unit_name);
	?>
</head>
<body>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">e-Unitfile</div>
			<div class="panel-body">
				<form action="home.php" method="post">
				<legend>Lecturer</legend><br>
					<p> Please select the unit that you wish to upload files. </p>
					Unit Code List
					<select name="unitcodeslist">
						<?php 
						while($stmt->fetch()){
							
								echo "<option value='$id'>$unit_code $unit_name</option>";	 
						}	
						?>

					</select>
					<input type="submit" value="Next"/>
				</form>
				<div id="approvelist">
				</div>
			</div>
		</div>
	</div>





</body>

</html>




