<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
					
					
	$stmt=$mysqli->prepare("SELECT unitcode,unitdesc FROM hod WHERE hodid =?");
	$stmt->bind_param('s',
		$_SESSION['loginid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname);
	
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
	<form>
	    <p> Please select the unit that you want to select. </p>
		Unit 
		<select name="unitcodelist" onchange="showUser(this.value)">
		
<?php 

	while($stmt->fetch()){	
	?> 		
			
		<?php
		if($unitcode!='')
		 echo "<option value='$unitcode'>$unitcode $unitname</option>";	 
		?>
	
<?php		
	}	

?>

	</select>
	<div id="txtHint"><b>Trimester info will be listed here.</b></div>
	<input type="submit" value="Select" onclick="result1.php"/>
	</form>
	
