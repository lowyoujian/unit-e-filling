
<html>
<script type="text/javascript" src="jquery-2.1.1.js"></script>
<head>
	<?php
	include('database_config.php');
	session_start();
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt2=$mysqli->prepare("SELECT unitcode,unitdesc FROM lecturer WHERE lecturerid =?");
	$stmt2->bind_param('s',
		$_SESSION['lecturerid']
		);
	$stmt2->execute();
	$stmt2->bind_result($unitcode,$unitname);
	?>
</head>
<body>
	<form action="home.php" method="GET">
		<p> Please select the unit that you wish to upload files. </p>
		Unit Code List
		<select name="unitcodeslist">
			<?php 
			while($stmt2->fetch()){
				if($unitcode!='')
				echo "<option value='$unitcode'>$unitcode $unitname</option>";	 
			}	
			?>

		</select>
		<input type="submit" value="Next"/>
	</form>
<?php
	$stmt3=$mysqli->prepare("SELECT hodunitcode,hodunitdesc FROM lecturer WHERE lecturerid =?");
	$stmt3->bind_param('s',
		$_SESSION['lecturerid']
		);
	$stmt3->execute();
	$stmt3->bind_result($hodunitcode,$hodunitname);
	
?>
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

	<div id="approvelist">

	</div
		
</body>

</html>




