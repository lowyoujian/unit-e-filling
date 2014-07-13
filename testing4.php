<?php
  $server="localhost";
  $user="root";
  $pass="";
  $database="team_project";
  
       
  # Connect to database
   $cn=mysql_connect($server,$user,$pass);
   if(!$cn) {
       die ("<br/>DB not connnected : " . mysql_error()); 
    }
   # Select a database	
   $db=mysql_select_db($database,$cn);
	if(!$db)
	   die(mysql_error() . "  " . mysql_errno());
	    
 
		
 
  $sql="select * from unitFile";
	  $res=mysql_query($sql, $cn);
	  while($r=mysql_fetch_array($res))
	  {
print<<<TTT

<div id='c'>
<br/>$r[7]
<input id='fileName' type='hidden' value='$r[0]' name='fileName'/>
<input class='approve' type='submit' value='Approve'/>
<input class='disapprove' type='submit' value='Disapprove'/>
</div>     
<div id="cn">
</div>
TTT;
}

	  mysql_close($cn);
?>
<script src="jquery-2.1.1.js"></script>
<script type="text/javascript">
$(document).ready(function () { 
$('.approve').click(function(){
var ths = this;
var str = $(ths).siblings("#fileName").val();
$.post("testing5.php", {t:str}, function(value){
document.getElementById("c").style.color="#33FF33";
});
});
});

$(document).ready(function () { 
$('.disapprove').click(function(){
var ths = this;
var str = $(ths).siblings("#fileName").val();
$.post("testing6.php", {t:str}, function(value){
document.getElementById("c").style.color="#FF0000";
});
});
});
</script>