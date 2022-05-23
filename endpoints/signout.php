<?php

session_start();

unset($_SESSION['user']['username']);
unset($_SESSION['user']['email']);
if(isset($_COOKIE[session_name()])):
    setcookie(session_name(), '', time()-7000000, '/');
endif;
session_destroy();

header("location: ../views/login.php ");
?>