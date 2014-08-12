<?php
$approvelist= $_GET['approvelist'];

//For counting number of files in folder
$directory = "upload/$approvelist/May2014/"; 
$filecount = count(glob($directory . "*.pdf"));

//For finding .pdf files in the folder
$phpfile = "upload/$approvelist/May2014/";
$phpfiles = glob($phpfile. "*.pdf");
$a=0;
foreach($phpfiles as $phpfile)
{
    $name=basename($phpfile);
    $filehref[$a]='upload/$approvelist/May2014/$name';
    $filename[$a]=$name;
    $a++;
}

?>  
<html>
<body>
    <fieldset>
        <legend><?php echo $approvelist;?></legend>
        

        <?php
        include('database_config.php');
        session_start();
        $mysqli = new mysqli($database['ip'], $database['username'], '', $database['database_name']);

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
        }

        $stmt=$mysqli->prepare("SELECT unitcode,semester FROM unitFile");   
        $stmt->execute();
        $stmt->bind_result($uc,$sem);
        
        for($j=0;$j<$filecount ; $j++){

            echo "<div id='c' style='margin-bottom:5px;'>";             
            echo "<a href='$filehref[$j]' id='fileName' name='fileName'>".$filename[$j]."</a>";
            echo "<div id='box[$j]' class='box' style='position:relative; float:right; left:5px; width:20px; height:20px; background-color:black; '></div>";                    
            echo "<input class='disapprove' type='submit' value='Disapprove' id='disapprove[$j]' name='dis[$j]' style='position:relative; float:right;'/>";             
            echo "<input class='approve' type='submit' value='Approve' id='approve[$j]' name='app[$j]' style='position:relative; float:right;'/> </div>";




        }

        ?>
        Total number of files : <?php echo $filecount;?><br/>

    </fieldset>
</body>
</html>

<script type="text/javascript">

for(var i=0; i<approve.length; i++)
    {


        $("approve["+i+"]").click(function(){

            var str = this.siblings("#fileName").attr("href");
            $.post("approve.php", {t:str}, function(value){
                $("box["+i+"]").css("backgroundColor","#33FF33");

            });
        });


        
        $("disapprove["+i+"]").click(function(){

            var str = this.siblings("#fileName").attr("href");
            $.post("disapprove.php", {t:str}, function(value){
                $("box["+i="]").css("backgroundColor","#FF0000");
            });
        });
    }


</script>