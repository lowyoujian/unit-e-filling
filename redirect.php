<?php
include('database_config.php');

		if($_SERVER['REQUEST_METHOD'] == "POST") {
	$date=date('M');

        if($date=="Oct"
            ||"Nov"
            ||"Dec"
            )
            {$date="Oct".date('Y');}

        if($date=="Jan"
            ||"Feb"
            ||"Mac"
            ||"Apr"
            ||"May"
            )
            {$date="Jan".date('Y');}

        if($date=="Jun"
            ||"Jul"
            ||"Aug"
            ||"Sept"
            )
            {$date="May".date('Y');}

$mysqli3 = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
		if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}
			$sql = <<<SQL
			UPDATE `lecturer_and_unit_files`
SET `num_lecture`={$_POST['numOfLectures']}, `num_tutorial`= {$_POST['numOfTutorials']}, `num_practical`={$_POST['numOfPracticals']}, `num_assignment`={$_POST['numOfAssignments']}, `num_test`={$_POST['numOfTests']}, `num_quiz`={$_POST['numOfQuizes']}
WHERE `unit_code`='{$_POST['unitcode']}' AND `trimester`= '$date';
SQL;

mysqli_query($mysqli3, $sql);


}

?>
<html>
<body>
<form style="display:none;" id="form1" action="home.php" method="post"/>
<input name="unit_code" value="<?php echo $_POST['unitcode'];?>"/>
</form>

<script>
document.getElementById("form1").submit();
</script>
