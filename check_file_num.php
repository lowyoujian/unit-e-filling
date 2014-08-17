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
$code = $_POST['unit_code'];
include('database_config.php');
$getDate = new CurrentTrimester();
$getDate->getCurrentTrimester();
	$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
			. $mysqli->connect_error);
	}
	$stmt=$mysqli->prepare("SELECT trimester, num_lecture, num_tutorial, num_practical, num_assignment, num_test, num_quiz FROM lecturer_and_unit_files WHERE unit_code=?");
	$stmt->bind_param('s', $_POST['unit_code']);
	$stmt->execute();
	$stmt->bind_result($trimester, $lectures, $tutorials, $practicals, $assignments, $tests, $quizes);
?>

<?php
while($stmt->fetch()){
	if($lectures == NULL && $tutorials == NULL && $practicals == NULL && $assignments == NULL && $tests == NULL && $quizes == NULL && $trimester == $getDate->date ){
	header("Location:set_file.php?unit_code=$code");
	}
}
?>
}
</script>
</head>
<body>
<?php
class CurrentTrimester {


    function getCurrentTrimester(){

        $date=date('M');

        if($date=="Oct"
            ||"Nov"
            ||"Dec"
            )
            {$this->date="Oct".date('Y');}

        if($date=="Jan"
            ||"Feb"
            ||"Mac"
            ||"Apr"
            ||"May"
            )
            {$this->date="Jan".date('Y');}

        if($date=="Jun"
            ||"Jul"
            ||"Aug"
            ||"Sept"
            )
            {$this->date="May".date('Y');}

        
    }
	}
?>
</body>
</html>