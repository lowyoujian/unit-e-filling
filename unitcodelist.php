<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'team_project');
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

	$stmt=$mysqli->prepare("SELECT unitcode,unitdesc,trimester FROM lecturer WHERE lecturerid =?");
	$stmt->bind_param('s',
		$_SESSION['lecturerid']);
	$stmt->execute();
	$stmt->bind_result($unitcode,$unitname,$trimester);
	?>
	<table border="1">
			<tr>
			<th>Unit</th>
			<th>Year/Trimester</th>
		    </tr>		
<?php 
	
	while($stmt->fetch()){
	
	?> 

		<tr>
		<td>
		<?php
		
		 echo "<a href='home.php?unitcode=$unitcode&trimester=$trimester'>$unitcode $unitname<br></a>"; 		 
		?>
		</td>
		
		<td>
		<?php echo "$trimester<br>"; 
		
		?>	
		</td>
		</tr>
		
<?php
		
	}
?>
		</table>
