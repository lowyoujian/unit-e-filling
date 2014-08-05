
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
<script type="text/javascript">
	function reqListener () {
		console.log(this.responseText);
	}

    var oReq = new XMLHttpRequest(); //New request object
    oReq.onload = function() {
        //This is where you handle what to do with the response.
        //The actual data is found on this.responseText
        //The data from get_hod_status, 1= is a hod, 0= not hod
        if(this.responseText){
        	$("#approvelist").append("Here are the list of files for you to verify<br><br>");
        	$("#approvelist").append("Unit Code List: ");
        	$("#approvelist").append("<select name='approvelist'><option value='unitcode'</option></select><input type='submit' value='next'/> ");

        }
    };
    oReq.open("get", "get_hod_status.php", true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to 
    //                                 continue.
    oReq.send();
    </script>
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
	<div id="approvelist">
	</div>
</body>

</html>




