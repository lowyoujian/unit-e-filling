<?php

//For counting number of files in folder
$directory = "C:/wamp/www/Testing/upload/";
$filecount = count(glob($directory . "*.pdf"));

//For finding .pdf files in the folder
$phpfile = "C:/wamp/www/Testing/upload/";
$phpfiles = glob($phpfile. "*.pdf");


foreach($phpfiles as $phpfile)
{
$name=basename($phpfile);
echo "<a href='upload/$name' download>".basename($phpfile,".pdf")."</a>";
echo "<br/>";
}

?>

