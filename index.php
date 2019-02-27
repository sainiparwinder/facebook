<!DOCTYPE html>
<html lang="en">
<head>

    <title>New facebook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body class=" bg-success">

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2"><h1>Facebook</h1></div>
        <div class="col-sm-2">&nbsp;</div>
        <form action="signIn.php" method="POST">
            <div class="col-sm-3">
                 Email or Phone
                <input type="text" class="form-control" id="user_id" name="user_id">
            </div>
            <div class="col-sm-3">
                Password
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="col-sm-2" style="margin-top: 20px;">
                <input type="submit" name="sign_in" class="btn btn-large btn-success" value="Log In">

            </div>
        </form>
    </div>
    <br />
    <br />
    <div class="row">
        <div class="col-sm-7"></div>
        <div class="col-sm-4">
            <form action="dataFiles.php" method="POST">
                <label for="email">Create an account<br>
                    It's free and always will be</label><br>
                <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name"><br>
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname"><br>
                <div class="form-group">
                    <input type="text" class="form-control" id="user_id" placeholder="Mobile number or email address"
                           name="user_id">
                </div>
                <input type="password" class="form-control" name="password" id="password" placeholder="New password"><br>
                <input type="password" class="form-control" name="conform_password" placeholder="Conform password"><br>
                <input type="submit" name="log_up" value="Sign Up">
        </div>
    </div>

</div>

</body>
</html>

