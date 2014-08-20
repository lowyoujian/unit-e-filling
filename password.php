<html>
<?php
session_start();
include('database_config.php');
$mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
if (isSet($_POST["newPassword"]) && isSet($_POST["currentPassword"]) && $_POST["currentPassword"] != '' && $_POST["newPassword"] != '' ) {
$new = $_POST["newPassword"];				
$cur = $_POST["currentPassword"];
$user = $_SESSION["user_id"];
	if (strlen ($new)>10 || strlen ($new)<6)
        	{
           		echo "<script type='text/javascript'>alert('Password must be between 6 and 10 characters!');  window.history.go(-1);	</script>";	
     	}else
	{
		$q = mysqli_query($mysqli, "SELECT * FROM `user` WHERE `user_id`='$user'");
		if (mysqli_num_rows($q) > 0) {
			$info = mysqli_fetch_array($q);
			if ($info['password'] == $cur) {
				$qq = mysqli_query($mysqli, "UPDATE `user` SET `password`='$new' WHERE `user_id`='$user'") or die(mysql_error());				
				if ($qq) {
					echo "<script type='text/javascript'>alert('Updated password!');  window.history.go(-1);</script>";		
				}else
					echo "<script type='text/javascript'>alert('Failed to update your password.');  window.history.go(-1);</script>";
			}else
				echo "<script type='text/javascript'>alert('Your entered current password was not correct. Please try again.');  window.history.go(-1);</script>";	
		}
	}
}
?>

<script type="text/javascript" src="jquery-2.1.1.js"></script>
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;
var color = "#FF0000";
currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "<font color="+color+">required</font>";
document.getElementById("newPassword").innerHTML ="";
document.getElementById("confirmPassword").innerHTML ="";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("currentPassword").innerHTML = "";
document.getElementById("newPassword").innerHTML ="<font color="+color+">required</font>";
document.getElementById("confirmPassword").innerHTML ="";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("currentPassword").innerHTML = "";
document.getElementById("newPassword").innerHTML ="";
document.getElementById("confirmPassword").innerHTML ="<font color="+color+">required</font>";
output = false;
}
else if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("currentPassword").innerHTML = "";
document.getElementById("newPassword").innerHTML = "<font color="+color+">password not match</font>";
document.getElementById("confirmPassword").innerHTML = "<font color="+color+">password not match</font>";
output = false;
} 	
return output;
}
</script>

<link rel="stylesheet" href="css/bootstrap.min.css"/>
<head>
<title>Change Password</title>
</head>
<body>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="0" width="600" height="250" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2">Change Password</td>
</tr>
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>

<a href='javascript:history.go(-1)'>Back</a>
</body>
</html>