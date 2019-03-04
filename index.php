<?php require_once 'database.php';?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>New facebook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body class=" bg-success">

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2"><h1>Facebook</h1></div>
        <div class="col-sm-2">&nbsp;</div>
        <form action="dashbord.php" method="POST">
            <div class="col-sm-3">
                 Email or Phone
                <input type="text" class="form-control" id="login_id" name="login_id">
                <h5 id=login_id_check></h5>
            </div>
            <div class="col-sm-3">
                Password
                <input type="password" class="form-control" name="password" id="password">
                <h5 id=login_pass_check></h5>
            </div>
            <div class="col-sm-2" style="margin-top: 20px;">
                <input type="submit" name="action" id="log_in" class="btn btn-large btn-success" value="Log In">
            </div>
        </form>
    </div>
    <br />
    <br />
    <div class="row">
        <div class="col-sm-7"></div>
        <div class="col-sm-4">
            <form action="function.php" method="POST">
                <label for="email">Create an account<br>
                    It's free and always will be</label><br>
                <div class="form-group">    
                    <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name" autocomplete="off">
                    <h5 id="name_check"></h5><br>
                <div>
                <div class="form-group">  
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" autocomplete="off">
                     <h5 id="surname_check"></h5>
               </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="user_id" placeholder="Mobile number or email address"
                           name="user_id" autocomplete="off">
                    <h5 id="userid_check"></h5>
                </div>
                 <div class="form-group">
                <input type="password" class="form-control" name="sign_up_pass" id="sign_up_pass" placeholder="New password" autocomplete="off">
                 <h5 id="pass_check"></h5>
                </div>
                  <div class="form-group">
                 <input type="password" class="form-control" name="conform_password" id="conform_password" placeholder="Conform password" autocomplete="off">
                 <h5 id="conpass_check">ggg</h5>
                </div>
                <input type="submit" name="action" id="sign_up" value="Sign Up">
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function(){
            $('#login_id_check').hide();
            $('#login_pass_check').hide();            
            $('#name_check').hide();
            $('#surname_check').hide();
            $('#userid_check').hide();
            $('#pass_check').hide();
            $('#conpass_check').hide();
            var loginIdErr = false;
            var loginPassErr=false;
            var nameErr = false;
            var surNameErr = false;
            var logupIdErr = false;
            var passwordErr = false;
            var conPassErr = false;
        $("#login_id").focusout(function(){
            loginidCheck();
        }); 
        function loginidCheck(){
            var loginidVal=$('#login_id').val();
            if(loginidVal==''){
                $('#login_id_check').show();
                $('#login_id_check').html("please inter login id");
                $('#login_id_check').focus();
                $('#login_id_check').css("color","red");
                var loginIdErr = true;
                return false;                
            }else{
                $('#login_id_check').hide();
            }
        }
        $('#password').focusout(function(){
            loginPassCheck();
        }); 
        function loginPassCheck(){
            var passVal=$('#password').val();
            if(passVal==''){
               $('#login_pass_check').show();
               $('#login_pass_check').html('please enter password'); 
               $('#login_pass_check').focus(); 
               $('#login_pass_check').css("color","red");
               loginPassErr=true;
               return false;  
            }else{
                $('#login_pass_check').hide();   
            }
        } 
        $('#log_in').click(function(){
            loginIdErr = false;
            loginPassErr=false;
            loginidCheck(); 
            loginPassCheck()
            if((loginIdErr==false) && (loginPassErr==false)){
                return true;
            }else{
                return false;
            } 
        }); 
        $("#first_name").focusout(function(){
            nameCheck();            
        });
        function nameCheck(){
            var nameVal=$("#first_name").val();
              if(nameVal.length==''){
                $('#name_check').show();
                $('#name_check').html("**please fill the name");
                $('#name_check').focus();
                $('#name_check').css("color","red");
                   nameErr = true;
                 //  return false;
              }else{
                 $('#name_check').hide();
              }
        }
        $("#surname").focusout(function(){
            surnameCheck();

        });
        function surnameCheck(){
            var nameVal=$("#surname").val();
              if(nameVal.length==''){
                $('#surname_check').show();
                $('#surname_check').html("**please fill the surname");
                $('#surname_check').focus();
                $('#surname_check').css("color","red");
                   surNameErr = true;
               //    return false;
              }else{
                 $('#surname_check').hide();
              }            
        }
        $("#user_id").focusout(function(){
            useridCheck();
        });
        function useridCheck(){
            var useridVal=$("#user_id").val();
              if(useridVal.length==''){
                $('#userid_check').show();
                $('#userid_check').html("**please fill the user_id");
                $('#userid_check').focus();
                $('#userid_check').css("color","red");
                   logupIdErr = true;

                //   return false;
              }else{
                 $('#userid_check').hide();
              }            
        }
        $('#sign_up_pass').focusout(function(){
            passwordCheck();

        });
        function passwordCheck(){
            var passwordVal=$('#sign_up_pass').val();
            if(passwordVal.length==''){
                $('#pass_check').show();
                $('#pass_check').html("please enter the password");
                $('#pass_check').focus();
                $('#pass_check').css("color","red");
                passwordErr=true;
            //    return false;
            }else{
                $('#pass_check').hide();
            }
        }
        $("#conform_password").focusout(function(){
            conpasswordCheck();
        });
        function conpasswordCheck(){
            var conpasswordVal=$('#conform_password').val();
            var passwordVal=$('#sign_up_pass').val();

            if(conpasswordVal!=passwordVal){
                $('#conpass_check').show();
                $('#conpass_check').html("**password not match");
                $('#conpass_check').focus();
                $('#conpass_check').css("color","red");
                conPassErr = true;
             //   return false;
            }else{
                $('#conpass_check').hide();
            }
        } 
        $('#sign_up').click(function(){
             nameErr = false;
             surNameErr = false;
             logupIdErr = false;
             passwordErr = false;
             conPassErr = false; 
            nameCheck();
            surnameCheck(); 
            useridCheck(); 
            passwordCheck(); 
            conpasswordCheck();            
            if((nameErr == false) && (surNameErr == false) && (logupIdErr == false) && (passwordErr == false) && (conPassErr == false)){
                
                return true;

            }else{
               
                return false;
            }           
              
        });     
    });
    
    
</script>

</body>
</html>

