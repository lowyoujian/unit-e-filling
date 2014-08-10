
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
				<form action="home.php" method="GET">
				<legend>Lecturer</legend><br>
					<p> Please select the unit that you wish to upload files. </p>
					Unit Code List
					<select name="unitcodeslist">
						<?php 
						while($stmt->fetch()){
							
								echo "<option value='$unit_code'>$unit_code $unit_name</option>";	 
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


<script type="text/javascript">
	function reqListener () {
		console.log(this.responseText);
	}

    var oReq = new XMLHttpRequest(); //New request object
    oReq.onload = function() {
        //This is where you handle what to do with the response.
        //The actual data is found on this.responseText
        //The data from get_hod_status, 1= is a hod, 0= not hod
        if(this.responseText==1){

			$("#approvelist").append("<fieldset><legend>HOD</legend><form action='linkfile.php' method='GET'>Here are the list of files for you to verify. Please select unit.<br>Unit Code List: <select name='approvelist'><?php 
			while($stmt3->fetch()){
				if($hodunitcode!='')
				echo "<option value='$hodunitcode'>$hodunitcode $hodunitname</option>";	 
			}	
			?></select><input type='submit' value='Next'/> ");
			$("#approvelist").append("</form></fieldset>");

        }
    };
    oReq.open("get", "get_hod_status.php", true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to 
    //                                 continue.
    oReq.send();
</script>


</body>

</html>




