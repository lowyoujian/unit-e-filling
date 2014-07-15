<?php

include('linkfile.php');

$name=basename($phpfile);
header("Content-disposition: attachment; filename=$name");
header("Content-type: application/pdf");
readfile($phpfile);

?>