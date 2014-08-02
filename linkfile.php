<?php
if($_GET['unitcodelist'] == '' || $_GET['trimesterlist'] == '')
{
?>
	<script>
	alert("Please make sure Unit Code or Trimester is not null. Please try again.");
	setTimeout(function () {
	window.location.href= 'hod_homepage.php'; // the redirect goes here

},0);
	</script>
	
<?php
}

else{	


$approvelist= $_GET['unitcodelist'];
$result_explode = explode(' ', $approvelist);
$uc=$result_explode[0]; //unit code
$un=$result_explode[1]; //unit name

//For counting number of files in folder
$directory = "upload/$uc/";
$filecount = count(glob($directory . "*.pdf"));

//For finding .pdf files in the folder
$phpfile = "upload/$uc/";
$phpfiles = glob($phpfile. "*.pdf");
?>
	
	<html>
	<body>
		<fieldset>
		<legend><?php echo $approvelist;?></legend>
	
	
<?php
foreach($phpfiles as $phpfile)
{

$name=basename($phpfile);
echo "<a href='upload/$uc/$name' download>".basename($phpfile)."</a>";
echo "<br/>";
}
}
?>

	</fieldset>
	</body>
	</html>