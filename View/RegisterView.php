<?php

namespace View;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="index.php?target=user&action=RegisterUser" method="post">
        <div>
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <div>
                <label for="usn"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="usn" id="usn" required>
            </div>

            <div>
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" id="email" required>
            </div>

            <div>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
            </div>

            <div>
                <label for="cpsw"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="cpsw" id="cpsw" required>
            </div>

            <hr>

            <input type="submit" name="create" value="Sign Up">
        </div>

        <div>
            <p>Already have an account? <a href="index.php?target=index&action=LogIn">Sign in</a>.</p>
        </div>
    </form>
</body>
</html>


