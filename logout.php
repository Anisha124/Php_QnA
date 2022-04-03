<?php
session_start();
echo "Logging you out. Please wait...";

session_destroy();
header("Location: /php/Php_QnA/home.php")
?>