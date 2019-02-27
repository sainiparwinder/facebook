<?php
      session_start();
      $con= mysqli_connect('localhost','root','gurunanak');
      $x=mysqli_select_db($con,'mydb');
      if(!empty($_POST['sign_in'])){
            $user_id=$_POST['user_id'];
            $q = "SELECT * FROM facebook_users WHERE user_id='$user_id'";
            $data=mysqli_query($con,$q);   
            $row=mysqli_fetch_row($data);
            if($row[3]==$user_id && $row[4]==$_POST['password']){              
                  $_SESSION["userName"] = "wellcome  $row[1] $row[2]";           
                  $_SESSION["uid"] = $row[0];           
            }else{
                echo "enter the correct email phone or password";
                header('Location: index.php');
            }      
      }
?>

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
    <div class="container-fluid"> 
        <div id="uploadModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload profile Photo</h4>
              </div>
              <div class="modal-body">                <!-- Form -->
                  <form method='post' action='' enctype="multipart/form-data" id="proficePhoto">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="uploadPhoto()">upload</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </form>
                  <!-- Preview-->
                  <div id='preview'></div>
              </div>         
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div id="photo" data-toggle="modal" data-target="#uploadModal"><br></div>
             <!-- button type="button" class="btn btn-info"  >update photo</button-->
             <p><?php $wc=$_SESSION["userName"]; echo $wc; ?> </p>
          </div>
          <div class="col-lg-4">
            <form action="javascript:void(0);" method="" >
              <div class="form-group">                            
                  <input type="text" id="search" name="search">                            
                  <button type="submit" class="btn btn-success" id='userpost1' onclick="searchUser()" >search</button>
              </div>
            </form>            
          </div>
          <div class="col-lg-4">
            <a href="index.php">log out</a>
          </div>
        </div>        
      <div class="row">
          <div class="col-lg-4" id="friendList"></div>
          <div class="col-lg-4">
            <form action="javascript:void(0);" method="" >
                <div class="form-group">
                  
                  <textarea class="form-control" rows="2" id="mypost" name="mypost"></textarea>
                  
                   <button type="submit" class="btn btn-success" id='userpost1' onclick="usrPost()" >Submit</button>
                </div>
            </form>
            <div class="row">
              <div  id="showPost" ></div> 
            </div>
          </div>
          <div class="col-lg-4">           
             <div  id="userList" ></div>    
          </div>
      </div>
      <div class="row"><div class="col-lg-4">           
             <div  id="friendList" ></div>    
          </div></div>  
</div> 
<script type="text/javascript">
      $(document).ready(function(){     //load data when form is loaded
              readPost();             
              request_list();
              showFriend();
              profilePhoto();
        });
       function reject(reject_id){
        $.ajax({
           url:"dataFiles.php",
           type:"POST",
           data:{reject_id:reject_id},
           success: function(data){                 
           showFriend();                            } 
        });
      }
      function accept(accept_id){
        $.ajax({ 
          url:"dataFiles.php",
          type:"POST",
          data:{accept_id:accept_id},
          success: function(data){
            $('#userList').html(data);
          }
        });
      }
      function showFriend(){
        var show_Friend="show_Friend";
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data:{show_Friend:show_Friend},
          success: function(data){
          $('#friendList').html(data);
          }
        });
      }
      function request_list(){
        var from_id="from_id";
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data:{from_id:from_id},
          success: function(data){
            console.log(data);
            $('#userList').html(data);
          }
        });
      }
      function addFriend(to_id){
       $.ajax({
        url:"dataFiles.php",
        type:"POST",
        data:{to_id:to_id},
        success: function(data){
          $('#userList').html(data);
        }
      });
     }
     function searchUser(){ 
      var search=$('#search').val();
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data:{search:search},
          success: function(data){
            $('#userList').html(data);
          }
        });
      }
      function readPost(){
       var readPost = "readPost";
       $.ajax({
        url:"dataFiles.php",
        type:"POST",
        data:{readPost:readPost},
        success: function(data){ 
          $('#showPost').html(data);
        }
      });
     }
     function usrPost(){
        var userPost=$('#mypost').val();
        var readrecords = "readrecords";
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data:{userPost:userPost,
          readrecords:readrecords},
          success: function(data){
            readPost();
          }
        });
      }
      function userList(id){ 
        var users = "users";
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data:{id:id},
          success: function(data){
            $('#userList').html(data);
          }
        });
      }
      function uploadPhoto(){
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data: new FormData($("#proficePhoto")[0]),
          contentType:false,
          processData: false,
          success: function(data){
            profilePhoto();
          }
        });
      }
      function profilePhoto(){
        var photo = "photo";
        $.ajax({
          url:"dataFiles.php",
          type:"POST",
          data:{photo:photo},
          success: function(data){
           $('#photo').html(data);
         }
       });
      }
</script>
</body>
</html>



