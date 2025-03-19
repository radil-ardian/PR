<?php
session_start();
session_destroy();
header("Location : logins1.php");
exit();
?>