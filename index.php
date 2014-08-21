<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">e-Unitfile Login</div>
			<div class="panel-body">

				<form class="form-horizontal" role="form" action="" method="POST" >
					<div class="form-group">
						<label for="loginid" class="col-sm-2 control-label">Login ID:</label>
						<div class="col-sm-3">

							<input type="loginid" name="login_id" class="form-control" value="10101010"  placeholder="ID">
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-3">
							<input type="password" name="password" class="form-control" value="10101010" id="inputEmail3" placeholder="Pas	sword">

						</div>
						<div class="row">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					<div class="col-md-4">
							<?php
	include('database_config.php');
	session_start();
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		
		$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);
		}

		$result= array();
	$stmt = $mysqli->prepare("SELECT * FROM user WHERE user_id=? AND password=?");
		
			$stmt->bind_param('ss',		
				$_POST['login_id'],
				$_POST['password']);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result(
				$result['user_id'],
				$result['password'],
				$result['name'],
				$result['position']
				);
			
			if ( $stmt->num_rows>0)
			{

				$stmt->fetch();
				
					
					$_SESSION['user_id']   = $result['user_id'];
					$_SESSION['user_name'] = $result['name_name'];
					switch ($result['position']){
						case 1:
							header('Location:unitcodelist.php');
							// lecturer page
							break;
						case 2:
							header('Location:mod_homepage.php');
							// Mod/lecturer page
							break;
						case 3: 
							header('Location:lecturer_assign.php');
							break;
							// Admin page
						default:exit();

					}
				
			}
			else{
				echo "<p style='color:red'>username password does not exist</p>";
			}
		
		
		
	}
	?>
						</div></div>
					
					
					
				</form>
			</div>
		</div>
	</div>


	
	
</body>
</html>


