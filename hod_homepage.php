<?php
session_start();
	$mysqli = new mysqli('localhost', 'root', '', 'team_project');
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt3=$mysqli->prepare("SELECT hodunitcode,hodunitdesc FROM lecturer WHERE lecturerid =?");
	$stmt3->bind_param('s',
		$_SESSION['lecturerid']
		);
	$stmt3->execute();
	$stmt3->bind_result($hodunitcode,$hodunitname);
	
	?>
	<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","trimesterOption.php?q="+str,true);
  xmlhttp.send();
}
	</script>
	<form method="get" action="linkfile.php">
	    <p> Please select the unit that you want to select for verify. </p>
		Unit Code
		<select name="unitcodelist" onchange="showUser(this.value)">
		
<?php 	
				echo "<option value =''> </option>";	
				while($stmt3->fetch()){
				if($hodunitcode!='')						
				echo "<option value='$hodunitcode $hodunitname'>$hodunitcode $hodunitname</option>";
				}
	

?>

	</select>
	<div id="txtHint"><b>Trimester info will be listed here.</b></div>
	<input type="submit" value="Select" onclick="linkfile.php"/>
	</form>
	
