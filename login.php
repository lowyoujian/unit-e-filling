<!DOCTYPE HTML>
<html>
<?php 
include('upload.php');
?>
<head>
	<title>Unit e-Filling</title>	

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">e-Unitfile Login</div>
			<div class="panel-body">

				<form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="loginid" class="col-sm-2 control-label">Login ID:</label>
						<div class="col-sm-3">
							<input type="loginid" class="form-control" id="logindid" placeholder="ID">
						</div>
					</div>
					
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-3">
							<input type="password" class="form-control" id="inputEmail3" placeholder="Password">

						</div>
						<div class="row">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
					
					
					
				</form>
			</div>
		</div>
	</div>




	
</body>
</html>


