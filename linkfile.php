<?php
$dpt=$_GET['department'];
$prog=$_GET['programme'];
$unit=$_GET['unit'];
include('database_config.php');
	session_start();
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
	$stmt=$mysqli->prepare("SELECT trimester FROM mod_and_unit WHERE user_id=? AND unit_code=?");
	$stmt->bind_param('ss',
		$_SESSION['user_id'],
		$unit);
	$stmt->execute();
	$stmt->bind_result($sem);
	$stmt->fetch();	



//For counting number of files in folder
$directory = "upload/$unit/$sem/"; 
$filecount = count(glob($directory . "*.pdf"));

//For finding .pdf files in the folder
$phpfile = "upload/$unit/$sem/";
$phpfiles = glob($phpfile. "*.pdf");
$a=0;
foreach($phpfiles as $phpfile)
{

$name=basename($phpfile);
$filehref[$a]="upload/$unit/$sem/$name";
$filename[$a]=$name;
$a++;
}

?>	
	<html>
	<style>
table,th,td
{
border:1px solid black;
border-collapse:collapse;
}
th,td
{
padding:5px;
}
	</style>
	<body>
		<fieldset>
		<legend><?php echo $unit;?></legend>
		
			
<?php

		
				echo "<table border='1'><tr>";
				echo "<tr><th>File</th><th>Approve</th><th>Disapprove</th><th>Status</th></tr>";
	for($j=0;$j<$filecount ; $j++){
				
				echo "<div id='c' style='margin-bottom:5px;'>";				
				echo "<td><a href='$filehref[$j]' id='fileName' name='fileName' download>".$filename[$j]."</a></td>";																	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve[$j]'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove[$j]'/></div></td>";	
				echo "<td><div id='box[$j]' class='box' style='width:20px; height:20px; background-color:black; '></div></td></tr>";
				
				
			}
				echo "</table>";
?>
	Total number of files : <?php echo $filecount;?><br/>
	
	</fieldset>
	</body>
	</html>
	

	
<?php for($i=0;$i<$filecount;$i++)
{
//Loop the function for every buttons
?>
<script src="jquery-2.1.1.js"></script>
<script type="text/javascript">

$(document).ready(function () { 
$(document.getElementById("approve[<?php echo $i;?>]")).click(function(){
var ths = this;
var str = $(ths).siblings("#fileName").attr("href");
$.post("approve.php", {t:str}, function(value){
document.getElementById("box[<?php echo $i;?>]").style.backgroundColor="#33FF33";

});
});
});

$(document).ready(function () { 
$(document.getElementById("disapprove[<?php echo $i;?>]")).click(function(){
var ths = this;
var str = $(ths).siblings("#fileName").attr("href");
$.post("disapprove.php", {t:str}, function(value){
document.getElementById("box[<?php echo $i;?>]").style.backgroundColor="#FF0000";
});
});
});

</script>

<?php 
}
?>

