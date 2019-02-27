
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
<body> 

<div class="container-fluid bg-success">
    <div class="row">
       <div class="col-sm-4">Facebook</div>
       <div class="col-sm-4">
        <form action="signIn.php" method="POST"> 
          Email or Phone
          <input type="text" class="form-control" id="user_id"  name="user_id">           
       </div>
       <div class="col-sm-4">
        Password  
        <input type="pasword" class="form-control" name="password" id="password" >
         <input type="submit" name="sign_in" class="btn-success" value="Log In">
       </form>
       </div>
  <div class="row">
       <div class="col-sm-3"></div>
       <div class="col-sm-4"> </div>
       <div class="col-sm-5">
         <form action="dataFiles.php" method="POST">              
            <label for="email">Create an account<br>
            It's free and always will be</label><br>
              <input type="text" class="" id="first_name" placeholder="First name" name="first_name">  
             <input type="text" class="" id="surname" name="surname" placeholder="Surname"><br>
             <div class="form-group">
                <input type="text" class="form-control" id="user_id" placeholder="Mobile number or email address" name="user_id">           
             </div>            
            <input type="pasword" class="form-control"name="password" id="password" placeholder="New password"><br>
            <input type="text" class="form-control" name="conform_password" placeholder="Conform password"><br>
           <input type="submit" name="log_up" value="Sign Up">
       </div>
</div> 

</div>

</body>
</html>

