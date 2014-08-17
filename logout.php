<?php
session_start();
if($_SESSION)

{
session_destroy();
 
?>

<script>
alert("You are now log out!!!")
window.location.href = "index.php";

</script>

<?php

}

?>
