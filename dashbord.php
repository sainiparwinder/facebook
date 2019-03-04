<?php
	require_once 'database.php';
	session_start();
	if(!isset($_SESSION["id"])){
	  header("Location: index.php");
	}
	if(!empty($_POST['login_id'])) {
		$pwd=$_POST['password'];
		$password=md5($pwd);		
		$q = "SELECT * FROM facebook_users WHERE (user_id='$_POST[login_id]' && password='$password')";
		$data=mysqli_query($con,$q);
		if(mysqli_num_rows($data) > 0){
			while ($row = mysqli_fetch_array($data)) {
				$_SESSION["id"]=$row["id"];
				$_SESSION["name"] ="$row[first_name]  $row[surname]";
				$_SESSION["photo"]=$row["profile_image"];
			}
		}else {
			echo "enter correct id or password";
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
</head>
<body class=" bg-success">
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="profilePhoto()">upload</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </form>
                  <!-- Preview-->
                  <div id='preview'></div>
              </div>         
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4" style="margin-top: 20px;">
            <div id="photo" data-toggle="modal" data-target="#uploadModal"><img src=<?php echo $_SESSION["photo"]; ?> class="img-circle" alt="photo" width="100" height="100"><br></div>
             <!-- button type="button" class="btn btn-info"  >update photo</button-->
             <p><?php echo $_SESSION["name"]; ?> </p>
          </div>
          <div class="col-lg-4" style="margin-top: 20px;">
            <form action="javascript:void(0);" method="" >
              <div class="form-group">                            
                  <input type="text" id="search" name="search">                            
                  <button type="submit" class="btn btn-success" id="search_btn" onclick="searchUser()" >search</button>
              </div>
            </form>            
          </div><div class="col-sm-3">&nbsp;</div>
          <div class="col-lg-1" style="margin-top: 20px;">
            <a href="index.php" class="btn btn-large btn-success">log out</a>
          </div>
        </div> 
        <div class="col-lg-2"  id="showRequest"></div>     
      
          <div class="col-lg-8">
            <form action="javascript:void(0);" method="" >
                <div class="form-group">
                  
                  <textarea class="form-control" rows="2" id="post" name="post"></textarea>
                  
                   <button type="submit" class="btn btn-success" id='post_btn' onclick="usrPost()" >Submit</button><br>
                </div>
            </form>
            <div >
              <div  id="showPost" ></div> 
            </div>
          </div>
          <div class="col-lg-2">           
             <div  id="searchList" ></div>    
          </div>
      </div>     
<script type="text/javascript">
	$(document).ready(function(){
		usrPost();
		showRequest();
		$('#post_btn').click(function(){
			$('#post').val('');
			});
	});
	
     function usrPost(){
        var post=$('#post').val();
       
       
        	$.ajax({
            url:"function.php",
            type:"POST",
            data:{post:post,
                 action:'post'},
            success: function(data){
          	$('#showPost').html(data);            
          }
        });
      }
      function profilePhoto(){        
        $.ajax({
          url:"function.php",
          type:"POST",
          data: new FormData($("#proficePhoto")[0]),         		
          contentType:false,
          processData: false,          
          success: function(data){
           $('#photo').html(data); 
          }
        });
      }
      function searchUser(){ 
	      var search=$('#search').val();
	      if(search!=''){
	        $.ajax({
	          url:"function.php",
	          type:"POST",
	          data:{search:search,
	                action:'search'},
	          success: function(data){
	            $('#searchList').html(data);
	          }
	        });
	    }
	}
	function friendStatus(id,status){
        $.ajax({
          url:"function.php",
          type:"POST",
          data:{id:id,
          		status:status,
                action:status},
          success: function(data){
          	$('#showPost').html(data);  
          	console.log(data);          
          }
        });		
	}
	function showRequest(){
        $.ajax({
          url:"function.php",
          type:"POST",
          data:{action:'showRequest'},
          success: function(data){
          	$('#showRequest').html(data);            
          }
        });		
	}      
</script>
</body>
</html>