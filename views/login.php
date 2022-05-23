<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="container pt-5 mt-5">
        <div id="responselogin"></div>
        <?php
            $secret="secretKey";
            $csrf = hash_hmac('SHA256', uniqid(microtime()), $secret);
            $_SESSION['csrf_token'] = $csrf;
        ?>
        <form method="POST" id="login" onsubmit="return login()">
            <input type="hidden" name="csrf" value="<?php echo $csrf?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class=" text-center ">
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
    <script src="../js/login.js"> </script>
</body>

</html>