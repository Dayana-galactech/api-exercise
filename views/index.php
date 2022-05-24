<?php
session_start();
// setcookie("user", $_SESSION['user']['username'], time() + 3600);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>

    <p>HELLO <?= $_SESSION['user']['username'] ?></p>
    <p></br>Your email is: <?= $_SESSION['user']['email'] ?></p>
    <p></br> Click here to <a href="../endpoints/signout.php" tite="Logout">Logout.</p>
</body>

</html>