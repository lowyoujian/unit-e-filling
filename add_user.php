<!DOCTYPE HTML>
<html>
<head>
	<title>Unit e-Filling</title>	
	<script src="script.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
		
</head>
<body>
<?php include 'title_bar.php'; ?>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Add User</div>
			<div class="panel-body">

				<form class="form-horizontal" name="form1" id="form1" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="userid" class="col-sm-2 control-label">User ID</label>
						<div class="col-sm-3">
							<input type="text" id="userID" name="userID" placeholder="1301188" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="userpass" class="col-sm-2 control-label">User Password</label>
						<div class="col-sm-5">
							<input type="text" id="userPass" name="userPass" placeholder="1301188" size="35"/>	
						</div>
					</div>
					
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">User Name</label>
						<div class="col-sm-3">
							<input type="text" id="userName" name="userName" placeholder="Low You Jian" size="35"/>							
						</div>
					</div>
					<div class="form-group">
						<label for="position" class="col-sm-2 control-label">Postion</label>
						<div class="col-sm-5">
						<select name="positionList" id="positionList">
						<option value='1'>Lecturer</option>
						<option value='2'>Moderator</option>
						<option value='3'>Admin</option>
						</select>
						</div>
					</div>
					
					</div>
				
					</div>
					
				<div id="div-save" class="input-attr">
					<button type="submit" >Save</button>
				</div>
				</form>


			</div>
	</div>
		<?php
		include('database_config.php');
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		
			
			$mysqli3 = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
	if ($mysqli3->connect_error) {
		die('Connect Error (' . $mysqli3->connect_errno . ') '
			. $mysqli3->connect_error);
	}
if($_POST['userID'] != NULL && $_POST['userPass'] != NULL && $_POST['userName'] != NULL){
			$sql = <<<SQL
INSERT INTO `user` (`user_id`, `password`, `name`, `position`)
VALUES (?, ?, ?, ?)
SQL;

			if ($stmt3 = $mysqli3->prepare($sql)) {
				$stmt3->bind_param('sssd', 
					$_POST['userID'],
					$_POST['userPass'],
					$_POST['userName'],
					$_POST['positionList']
				);
				
				$stmt3->execute();
				$stmt3->close();
				?>
				<script>
	alert("Successful Add User!!!");
	</script><?php
				
				exit;
			}
			else {
				die('Database Error (' . $mysqli3->errno . ') '
					. $mysqli3->error);	
			}			
		
	}
	}
	?>
</body>
</html>