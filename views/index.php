<?php
if(session_id() == ''){
    session_start();
  }
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
    <p></br> Click here to <a href="http://localhost:8012/api-exercise/?url=/users/logout" tite="Logout">Logout.</p>
</body>

</html>