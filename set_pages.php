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
			
$stmt3= $mysqli3->prepare("UPDATE `lecturer_and_unit_files`
SET `num_lecture`={$_POST['numOfLectures']}, `num_tutorial`= {$_POST['numOfTutorials']}, `num_practical`={$_POST['numOfPracticals']}, `num_assignment`={$_POST['numOfAssignments']}, `num_test`={$_POST['numOfTests']}, `num_quiz`={$_POST['numOfQuizes']}
WHERE `unit_code`='${$_POST['unit_code']}' AND `trimester`= '$date'");
    $stmt3->execute();
header('Location: home.php');
exit;
}

	?>
