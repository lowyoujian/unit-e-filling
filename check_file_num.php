<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	
<script src="jquery-2.1.1.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>
function check(){
<?php
var_dump($_POST);
$code = $_POST['unitcodeslist'];
include('database_config.php');
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt=$mysqli->prepare("SELECT num_lecture, num_tutorial, num_practical, num_assignment, num_test, num_quiz FROM lecturer_and_unit_files WHERE unit_id=?");
	$stmt->bind_param('s', $_POST['unitcodeslist']);
	$stmt->execute();
	$stmt->bind_result($lectures, $tutorials, $practicals, $assignments, $tests, $quizes);
?>

<?php
while($stmt->fetch()){
	if($lectures == NULL && $tutorials == NULL && $practicals == NULL && $assignments == NULL && $tests == NULL && $quizes == NULL ){
	header("Location:set_file.php?unitcode=$code");
	}
}
?>
}
</script>
</head>
<body>
</body>
</html>