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

							<input type="loginid" name="lecturerid" class="form-control" value="1" id="logindid" placeholder="ID">
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-3">
							<input type="password" name="password" class="form-control" value="1" id="inputEmail3" placeholder="Pas	sword">

						</div>
						<div class="row">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
					
					
					
				</form>
			</div>
		</div>
	</div>


	<?php
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		
		$mysqli = new mysqli('localhost', 'root', '', 'team_project');
		if ($mysqli->connect_error) {
			die('Connect Error (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);
		}

		$result= array();
		
		if ($stmt = $mysqli->prepare("SELECT * FROM login WHERE lecturerid=? AND password=?"))
		{
			$stmt->bind_param('ss',		
				$_POST['lecturerid'],
				$_POST['password']);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result(
				$result['lecturerID'],
				$result['password']
				);
			
			if ( $stmt->num_rows>0)
			{

				if($stmt->fetch())
				{
				
						session_start();
						$_SESSION['lecturerid']=$result['lecturerID'];
						header('Location:unitcodelist.php');
					
					
					
				}
			}
		}
		
		
	}
	?>

	
</body>
</html>


