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
<div>
    <form action="index.php?target=user&action=Log" method="post">
        <h1>Sign In</h1>
        <hr>
            <div>
                <label for="usn"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="usn" id="usn" required>
            </div>

            <div>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
            </div>
        <hr>

        <input type="submit" name="create" value="Sign In">
    </form>
</div>
</body>
</html>
