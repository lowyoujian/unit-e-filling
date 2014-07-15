<?php



$phpfile = "C:/wamp/www/Testing/upload/";

$phpfiles = glob($phpfile. "*.pdf");
$download="download.php";

foreach($phpfiles as $phpfile)
{
echo "<a href='download.php'>".basename($phpfile,".pdf")."</a>";
echo "<br/>";
}


?>
