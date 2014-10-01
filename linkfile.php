<link rel="stylesheet" href="css/bootstrap.min.css"/>
<div class="container">
	<table>
		<tr>
			<td align='center'><a href='mod_homepage.php' class="btn btn-default">Home</a></td>			
			<td align='center'><a href="logout.php" class="btn btn-default">Logout</a></td>
		</tr>
	</table>
</div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">File Verifications</div>
			<div class="panel-body">
			
			
<?php
$dpt=$_GET['department'];
$prog=$_GET['programme'];
$unit=$_GET['unit'];
include('database_config.php');
	session_start();
	
	//Match unit table information to determine unit_name exists 
	$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}

					
	$stmts=$mysqli->prepare("SELECT unit_name FROM unit WHERE unit_code=? AND programme_id=? AND department_id=?");
	$stmts->bind_param('sss',
		$unit,
		$prog,
		$dpt);
	$stmts->execute();
	$stmts->bind_result($unitname);
	$stmts->fetch();	
	
	if($unitname != null)
	{
	
	$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
	
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') '
						. $mysqli->connect_error);
			}
	$stmt=$mysqli->prepare("SELECT unit_id,trimester FROM mod_and_unit WHERE user_id=? AND unit_code=?");
	$stmt->bind_param('ss',
		$_SESSION['user_id'],
		$unit);
	$stmt->execute();
	$stmt->bind_result($unit_id,$sem);
	$stmt->fetch();	

	$mysqli = new mysqli($database['ip'], $database['username'], $database['password'], $database['database_name']);
$user_id=$_SESSION['user_id'];
$stmt2=$mysqli->prepare("SELECT trimester,num_lecture,num_tutorial,num_quiz,num_test,num_practical,num_assignment FROM lecturer_and_unit_files WHERE unit_code=? AND unit_id=?");
$stmt2->bind_param('ss',
    $unit,   
    $unit_id);
$stmt2->execute();
$stmt2->bind_result($trimester,$num_lecture,$num_tutorial,$num_quiz,$num_test,$num_practical,$num_assignment);
$stmt2->fetch();	

//Find total file to get number of missing files
$numberOfFiles=$num_lecture+$num_tutorial+$num_quiz+$num_test+$num_practical+$num_assignment+$num_quiz+$num_test+$num_tutorial+6;
//For counting number of files in folder
$directory = "upload/$unit/$sem/"; 
$filecount = count(glob($directory . "*.pdf"));
$missingFiles=$numberOfFiles-$filecount;

//For finding .pdf files in the folder
$phpfile = "upload/$unit/$sem/";
$phpfiles = glob($phpfile. "*.pdf");
$a=1;
foreach($phpfiles as $phpfile)
{

$name=basename($phpfile);
$filehref[$a]="upload/$unit/$sem/$name";
$filename[$a]=$name;

$a++;
}

?>	
	<html>
	<head>
	<title>File Verifications</title>   
	
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="jquery-2.1.1.js"></script>
	</head>
	<style>
th
{
	text-align:center;
}
th#status
{
	width:150px;
}

	</style>
	<body>
		<fieldset>
		<legend><?php echo "$unit $unitname"?></legend>
		
			
<?php
//Initialize all file status as false			
for($s=1;$s<=16;$s++)
{
$filestatus[$s]=false;
$matchFileName[$s]='';
$matchFileName2[$s]='';
$matchFileName3[$s]='';
$matchFileName4[$s]='';
$matchFileName5[$s]='';
$matchFileName6[$s]='';
$matchFileName7[$s]='';
$matchFileName8[$s]='';
$matchFileName9[$s]='';
$matchFileName10[$s]='';
}
		
				echo "<table class='table' border='1'>";
				echo "<tr><th>File</th><th>Exist</th><th>Exists</th><th>Approve</th><th>Disapprove</th><th id='status'>Status</th></tr>";
			
				for($j=1;$j<=$numberOfFiles ; $j++){
					for($x=1;$x<=$filecount;$x++){
					
					if($filename[$x]=="$unit"."_"."$sem"."_"."assignment"."$j".".pdf")
					{	
						$matchFileName[$j]=$filename[$x];
						$filestatus[1]=true;	
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."lecture"."$j".".pdf")
					{
						$matchFileName2[$j]=$filename[$x];
						$filestatus[2]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."quiz"."$j".".pdf")
					{
						$matchFileName3[$j]=$filename[$x];
						$filestatus[3]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."quiz"."_"."solution"."$j".".pdf")
					{
						$matchFileName4[$j]=$filename[$x];
						$filestatus[4]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."test"."$j".".pdf")
					{
						$matchFileName5[$j]=$filename[$x];
						$filestatus[5]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."test"."_"."solution"."$j".".pdf")
					{
						$matchFileName6[$j]=$filename[$x];
						$filestatus[6]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."tutorial"."$j".".pdf")
					{
						$matchFileName7[$j]=$filename[$x];
						$filestatus[7]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."tutorial"."_"."solution"."$j".".pdf")
					{
						$matchFileName8[$j]=$filename[$x];
						$filestatus[8]=true;
					}
				
					if($filename[$x]=="main.pdf")
					{
						$matchFileNameMAIN=$filename[$x];
						$filestatus[9]=true;
					}
					if($filename[$x]=="unit matrix $unit.pdf")
					{
						$matchFileNameUM=$filename[$x];
						$filestatus[10]=true;
					}
					if($filename[$x]=="academic report $unit.pdf")
					{
						$matchFileNameAR=$filename[$x];
						$filestatus[11]=true;
					}
					if($filename[$x]=="misc$unit.pdf")
					{
						$matchFileNameMISC=$filename[$x];
						$filestatus[12]=true;
					}
					if($filename[$x]=="syllabus.pdf")
					{
						$matchFileNameSYL=$filename[$x];
						$filestatus[13]=true;
					}
					if($filename[$x]=="teaching plan.pdf")
					{
						$matchFileNameTP=$filename[$x];
						$filestatus[14]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."practical"."$j".".pdf")
					{
						$matchFileName9[$j]=$filename[$x];
						$filestatus[15]=true;
					}
					if($filename[$x]=="$unit"."_"."$sem"."_"."practical"."_"."solution"."$j".".pdf")
					{
						$matchFileName10[$j]=$filename[$x];
						$filestatus[16]=true;
					}	
					
				}
				}
				
				for($j=1;$j<=$num_assignment ; $j++){	
				echo "<div id='c' style='margin-bottom:5px;'><tr>";
				if($filestatus[1] && $matchFileName[$j] == "$unit"."_"."$sem"."_"."assignment"."$j".".pdf") 
				{
				echo "<td><a href='upload/$unit/$sem/$matchFileName[$j]' id='fileName1[$j]' name='fileName1[$j]' download>$unit","_$sem","_assignment$j.pdf</a></td>";
				echo "<td><img id='checkbox1[$j]' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists1[$j]'>Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve' id='approve1[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove1[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box1[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text1[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_assignment$j.pdf</td>";
				echo "<td><img id='checkbox1[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists1[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true'  /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				}
				 
				
				
			
				for($j=1;$j<=$num_lecture ; $j++){									
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[2] && $matchFileName2[$j] == "$unit"."_"."$sem"."_"."lecture"."$j".".pdf")
				{
				echo "<td><a href='upload/$unit/$sem/$matchFileName2[$j]' id='fileName2[$j]' name='fileName2[$j]' download>$unit","_$sem","_lecture$j.pdf</a></td>";
				echo "<td><img id='checkbox2[$j]' width='12px'  src='images/tick.jpg'  /></td>";	
				echo "<td><div id='exists2[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve2[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove2[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box2[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text2[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_lecture$j.pdf</td>";
				echo "<td><img id='checkbox2[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists2[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				}
			
			
				for($j=1;$j<=$num_quiz ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[3] && $matchFileName3[$j] == "$unit"."_"."$sem"."_"."quiz"."$j".".pdf")
				{
				echo "<td><a href='upload/$unit/$sem/$matchFileName3[$j]' id='fileName3[$j]' name='fileName3[$j]' download>$unit","_$sem","_quiz$j.pdf</a></td>";
				echo "<td><img id='checkbox3[$j]' width='12px'  src='images/tick.jpg'  /></td>";	
				echo "<td><div id='exists3[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve3[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove3[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box3[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text3[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_quiz$j.pdf</td>";
				echo "<td><img id='checkbox3[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists3[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}	
				}
			
				for($j=1;$j<=$num_quiz ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";		
				if($filestatus[4] && $matchFileName4[$j] == "$unit"."_"."$sem"."_"."quiz"."_"."solution"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName4[$j]' id='fileName4[$j]' name='fileName4[$j]' download>$unit","_$sem","_quiz_solution$j.pdf</a></td>";
				echo "<td><img id='checkbox4[$j]' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists4[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve4[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove4[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box4[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text4[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_quiz_solution$j.pdf</td>";
				echo "<td><img id='checkbox4[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists4[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve' disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}								
				}
			
				for($j=1;$j<=$num_test ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[5] && $matchFileName5[$j] == "$unit"."_"."$sem"."_"."test"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName5[$j]' id='fileName5[$j]' name='fileName5[$j]' download>$unit","_$sem","_test$j.pdf</a></td>";
				echo "<td><img id='checkbox5[$j]' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists5[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve5[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove5[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box5[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text5[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_test$j.pdf</td>";
				echo "<td><img id='checkbox2[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists2[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				}
			
				for($j=1;$j<=$num_test ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[6] && $matchFileName6[$j] == "$unit"."_"."$sem"."_"."test"."_"."solution"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName6[$j]' id='fileName6[$j]' name='fileName6[$j]' download>$unit","_$sem","_test_solution$j.pdf</a></td>";
				echo "<td><img id='checkbox6[$j]' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists6[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve6[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove6[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box6[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text6[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_test_solution$j.pdf</td>";
				echo "<td><img id='checkbox6[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists6[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				}
			
				for($j=1;$j<=$num_tutorial ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[7] && $matchFileName7[$j] == "$unit"."_"."$sem"."_"."tutorial"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName7[$j]' id='fileName7[$j]' name='fileName7[$j]' download>$unit","_$sem","_tutorial$j.pdf</a></td>";
				echo "<td><img id='checkbox7[$j]' width='12px'  src='images/tick.jpg'  /></td>";	
				echo "<td><div id='exists7[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve7[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove7[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box7[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text7[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_tutorial$j.pdf</td>";
				echo "<td><img id='checkbox7[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists7[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
					
				}
			
				for($j=1;$j<=$num_tutorial ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";		
				if($filestatus[8] && $matchFileName8[$j] == "$unit"."_"."$sem"."_"."tutorial"."_"."solution"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName8[$j]' id='fileName8[$j]' name='fileName8[$j]' download>$unit","_$sem","_tutorial_solution$j.pdf</a></td>";
				echo "<td><img id='checkbox8[$j]' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists8[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve8[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove8[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box8[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text8[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_tutorial_solution$j.pdf</td>";
				echo "<td><img id='checkbox8[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists8[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				}
				
				for($j=1;$j<=$num_practical ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[15] && $matchFileName9[$j] == "$unit"."_"."$sem"."_"."practical"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName9[$j]' id='fileName15[$j]' name='fileName15[$j]' download>$unit","_$sem","_practical$j.pdf</a></td>";
				echo "<td><img id='checkbox15[$j]' width='12px'  src='images/tick.jpg'  /></td>";	
				echo "<td><div id='exists15[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve15[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove15[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box15[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text15[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_practical$j.pdf</td>";
				echo "<td><img id='checkbox15[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists15[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
					
				}
			
				for($j=1;$j<=$num_practical ; $j++){				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";		
				if($filestatus[16] && $matchFileName10[$j] == "$unit"."_"."$sem"."_"."practical"."_"."solution"."$j".".pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileName10[$j]' id='fileName16[$j]' name='fileName16[$j]' download>$unit","_$sem","_practical_solution$j.pdf</a></td>";
				echo "<td><img id='checkbox16[$j]' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists16[$j]'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve16[$j]' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove16[$j]' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box16[$j]' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text16[$j]' style='margin-left:30px;'></div></td></tr>";
				}
				else
				{
				echo "<td>$unit","_$sem","_practical_solution$j.pdf</td>";
				echo "<td><img id='checkbox16[$j]' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists16[$j]'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				}
			
				echo "<div id='c' style='margin-bottom:5px;'><tr>";
				if($filestatus[9] && $matchFileNameMAIN == "main.pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileNameMAIN' id='fileName9' name='fileName9' download>main.pdf</a></td>";
				echo "<td><img id='checkbox9' width='12px'  src='images/tick.jpg'  /></td>";	
				echo "<td><div id='exists9'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve9' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove9' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box9' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text9' style='margin-left:30px;'></td></tr>";
				}
				else
				{
				echo "<td>main</td>";
				echo "<td><img id='checkbox9' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists9'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[10] && $matchFileNameUM == "unit matrix $unit.pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileNameUM' id='fileName10' name='fileName10' download>unit matrix $unit.pdf</a></td>";	
				echo "<td><img id='checkbox10' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists10'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve10' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove10' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box10' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text10' style='margin-left:30px;'></td></tr>";
				}
				else
				{
				echo "<td>unit matrix $unit.pdf</td>";
				echo "<td><img id='checkbox10' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists10'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve' disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";
				if($filestatus[11] && $matchFileNameAR == "academic report $unit.pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileNameAR' id='fileName11' name='fileName11' download>academic report $unit.pdf</a></td>";
				echo "<td><img id='checkbox11' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists11'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve11' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove11' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box11' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text11' style='margin-left:30px;'></td></tr>";
				}
				else
				{
				echo "<td>academic report $unit.pdf</td>";
				echo "<td><img id='checkbox11' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists11'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[12] && $matchFileNameMISC == "misc$unit.pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileNameMISC' id='fileName12' name='fileName12' download>misc$unit.pdf</a></td>";
				echo "<td><img id='checkbox12' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists12'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve12' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove12' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box12' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text12' style='margin-left:30px;'></td></tr>";
				}
				else
				{
				echo "<td>misc$unit.pdf</td>";
				echo "<td><img id='checkbox12' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists12'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve' disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";	
				if($filestatus[13] && $matchFileNameSYL == "syllabus.pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileNameSYL' id='fileName13' name='fileName13' download>syllabus.pdf</a></td>";
				echo "<td><img id='checkbox13' width='12px'  src='images/tick.jpg'  /></td>";
				echo "<td><div id='exists13'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve13' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove13' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box13' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text13' style='margin-left:30px;'></td></tr>";
				}
				else
				{
				echo "<td>syllabus</td>";
				echo "<td><img id='checkbox13' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists13'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				echo "<div id='c' style='margin-bottom:5px;'><tr>";
				if($filestatus[14] && $matchFileNameTP == "teaching plan.pdf")
				{	
				echo "<td><a href='upload/$unit/$sem/$matchFileNameTP' id='fileName14' name='fileName14' download>teaching plan.pdf</a></td>";
				echo "<td><img id='checkbox14' width='12px'  src='images/tick.jpg'  /></td>";	
				echo "<td><div id='exists14'>Found</div></td>";	
				echo "<td><input class='approve' type='submit' value='Approve' id='approve14' style='color:black; background-color:green;'/></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove' id='disapprove14' style='color:black; background-color:red;'/></div></td>";	
				echo "<td><div id='box14' class='box' style='width:20px; height:20px; background-color:black; </div>'><div id='text14' style='margin-left:30px;'></td></tr>";
				}
				else
				{
				echo "<td>teaching plan</td>";
				echo "<td><img id='checkbox14' width='12px'  src='images/cross.jpg'  /></td>";
				echo "<td><div id='exists14'>Not Found</div></td>";
				echo "<td><input class='approve' type='submit' value='Approve'  disabled='true' /></td>";
				echo "<td><input class='disapprove' type='submit' value='Disapprove'  disabled='true' /></div></td>";	
				echo "<td>Not Available</td></tr>";
				}
				
				
				echo "</table>";
?>
	Total number of uploaded files : <?php echo $filecount;?><br/>
	Total number of missing files : <?php echo $missingFiles;?><br/>
	</fieldset>
	</div>
</div>
</div>
	</body>




</html>

<?php //assume the array maximum size is 20 only?>	
<?php for($i=1;$i<=20;$i++)
{
//to obtain fileName1 to fileName8 id 
for($p=1;$p<=8;$p++)
{
//Loop the function for every buttons
?>
<script src="jquery-2.1.1.js"></script>
<script type="text/javascript">

$(document).ready(function () { 
$(document.getElementById("approve<?php echo $p;?>[<?php echo $i;?>]")).click(function(){
var ths = this;
var str = $(document.getElementById("fileName<?php echo $p;?>[<?php echo $i;?>]")).text();	
$.post("approve.php", {t:str}, function(value){

document.getElementById("box<?php echo $p;?>[<?php echo $i;?>]").style.backgroundColor="#33FF33";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").innerHTML="Approved";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").style.color="green";
});
});
});


$(document).ready(function () { 
$(document.getElementById("disapprove<?php echo $p;?>[<?php echo $i;?>]")).click(function(){
var ths = this;
var str = $(document.getElementById("fileName<?php echo $p;?>[<?php echo $i;?>]")).text();
$.post("disapprove.php", {t:str}, function(value){

document.getElementById("box<?php echo $p;?>[<?php echo $i;?>]").style.backgroundColor="#FF0000";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").innerHTML="Disapproved";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").style.color="red";
});
});
});

</script>

<?php 
}
}
?>
<?php for($i=1;$i<=20;$i++)
{
//to obtain fileName9 to fileName10 id 
for($p=15;$p<=16;$p++)
{
//Loop the function for every buttons
?>
<script src="jquery-2.1.1.js"></script>
<script type="text/javascript">

$(document).ready(function () { 
$(document.getElementById("approve<?php echo $p;?>[<?php echo $i;?>]")).click(function(){
var ths = this;
var str = $(document.getElementById("fileName<?php echo $p;?>[<?php echo $i;?>]")).text();	
$.post("approve.php", {t:str}, function(value){

document.getElementById("box<?php echo $p;?>[<?php echo $i;?>]").style.backgroundColor="#33FF33";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").innerHTML="Approved";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").style.color="green";
});
});
});


$(document).ready(function () { 
$(document.getElementById("disapprove<?php echo $p;?>[<?php echo $i;?>]")).click(function(){
var ths = this;
var str = $(document.getElementById("fileName<?php echo $p;?>[<?php echo $i;?>]")).text();
$.post("disapprove.php", {t:str}, function(value){

document.getElementById("box<?php echo $p;?>[<?php echo $i;?>]").style.backgroundColor="#FF0000";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").innerHTML="Disapproved";
document.getElementById("text<?php echo $p;?>[<?php echo $i;?>]").style.color="red";
});
});
});

</script>

<?php 
}
}

for($o=9;$o<=14;$o++)
{
?>

<script type="text/javascript">

$(document).ready(function () { 
$(document.getElementById("approve<?php echo $o;?>")).click(function(){
var ths = this;
var str = $(document.getElementById("fileName<?php echo $o;?>")).text();	
$.post("approve.php", {t:str}, function(value){
document.getElementById("box<?php echo $o;?>").style.backgroundColor="#33FF33";
document.getElementById("text<?php echo $o;?>").innerHTML="Approved";
document.getElementById("text<?php echo $o;?>").style.color="green";
});
});
});


$(document).ready(function () { 
$(document.getElementById("disapprove<?php echo $o;?>")).click(function(){
var ths = this;
var str = $(document.getElementById("fileName<?php echo $o;?>")).text();	
$.post("disapprove.php", {t:str}, function(value){
document.getElementById("box<?php echo $o;?>").style.backgroundColor="#FF0000";
document.getElementById("text<?php echo $o;?>").innerHTML="Disapproved";
document.getElementById("text<?php echo $o;?>").style.color="red";
});
});
});

</script>

<?php
}
}
else
{
?>
<script>
	alert("Invalid unit selection.");
	setTimeout(function () 
	{  
		window.location.href= 'mod_homepage.php'; // the redirect goes here 
	},0);
</script>


<?php
}
?>
