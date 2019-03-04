<?php
require_once 'database.php';
session_start();
if (!empty($_POST['action'])) {
	switch ($_POST['action']) {
		case "Sign Up" :
		{
			$user_id=$_POST['user_id'];
			$pwd=$_POST['sign_up_pass'];
			$password=md5($pwd);
			$q="SELECT * FROM `facebook_users` WHERE `user_id`='$user_id'";
			$data = mysqli_query($con, $q);
			if (mysqli_num_rows($data) == 0) {
				$q = "INSERT INTO `facebook_users`( `first_name`, `surname`, `user_id`, `password`) VALUES ('$_POST[first_name]','$_POST[surname]','$user_id','$password')";
				mysqli_query($con, $q);	
				 header("Location: index.php");	
			}

 		
			break;
		}
		case "post" :
		{   
			$post=$_POST['post'];
		 if($post!=''){
		   $id=$_SESSION["id"];
		   $q = "INSERT INTO `user_posts`(`user_id`, `post`) VALUES ('$id','$_POST[post]')";
           mysqli_query($con, $q);
         }
           $q = "SELECT  * FROM `user_posts` ORDER BY id desc";
           $data = mysqli_query($con, $q);
           $post = '';
           if (mysqli_num_rows($data) > 0) {
           	while ($row = mysqli_fetch_array($data)) {
           		$post .= '<tr> <td>'.$row["post"].'</td></tr><br>';
           	}
           	echo $post;
           }
			break;
		}
		case "search" :
		{
		   $srch = $_POST['search'];
		   $q = "SELECT * FROM `facebook_users` where first_name LIKE '%$srch%'";
		   $data = mysqli_query($con, $q);
		   $p = '';
		   if (mysqli_num_rows($data) > 0) {
		   	 while ($row = mysqli_fetch_array($data)) {
		   	 	$p .='<tr> 
		   	 	<td>'. $row["first_name"].'</td>
		   	 	<td>' . $row["surname"] . '</td>
		   	 	<td><button onclick="friendStatus('. $row['id'].',1)" class="btn btn-success">Add Friend</button></td></tr><br>';
		   	 }  // die(mysqli_error($con));
		   	 echo $p;
		   	}
			break;	   
		}
		case "1" :	//friend request send
		{
			$id=$_SESSION["id"];
			$q="SELECT * FROM `friend_requests` WHERE (from_id='$id' AND to_id='$_POST[id]') OR (from_id='$_POST[id]' AND to_id='$id')";
			$data = mysqli_query($con, $q);
			if (mysqli_num_rows($data) == 0) {
				$q="INSERT INTO `friend_requests`(`from_id`, `to_id`, `status`) VALUES ('$id','$_POST[id]','request')";
				mysqli_query($con, $q);				
			}			
			break;
		} 
		case "2" :	//friend request accept
		{  $id=$_SESSION["id"];
		   $q="UPDATE `friend_requests` SET `status`='friend' WHERE from_id='$_POST[id]' AND to_id='$id'";
		   mysqli_query($con, $q);
		   die(mysqli_error($con));
			break;
		}
		case "3" :	//friend request reject
		{  $id=$_SESSION["id"];
		   $q="UPDATE `friend_requests` SET `status`='reject' WHERE from_id='$_POST[id]' AND to_id='$id'";
		   mysqli_query($con, $q);
		   die(mysqli_error($con));
			break;
		} 
		case "showRequest" :
		{
			$id = $_SESSION["id"];
			$q = "SELECT *  FROM `friend_requests` WHERE to_id=$id && status='request'";
			$data = mysqli_query($con, $q);
			$p = '';
			if (mysqli_num_rows($data) > 0) {
				while ($row = mysqli_fetch_array($data)) {
					$p .= '<tr> <td>'.requestList($row["from_id"]).'</td> ';
				}
				echo $p;
			}
			break;
		}	
			
			
		case "" :
		{	
			break;
		} 
		case "" :
		{	
			break;
		} 					    		       
    }
}
if (isset($_FILES["fileToUpload"]["name"])) {

$id=$_SESSION["id"];
			$target_dir = "uploads/";
		    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		    // Check if image file is a actual image or fake image
		    if (isset($_POST["submit"])) {
		        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		        if ($check !== false) {
		            echo "File is an image - " . $check["mime"] . ".";
		            $uploadOk = 1;
		        } else {
		            echo "File is not an image.";
		            $uploadOk = 0;
		        }
		    }
		    // Check if file already exists
		    if (file_exists($target_file)) {
		        echo "Sorry, file already exists.";
		        $uploadOk = 0;
		    }
		    // Check file size
		    if ($_FILES["fileToUpload"]["size"] > 500000) {
		        echo "Sorry, your file is too large.";
		        $uploadOk = 0;
		    }
		    // Allow certain file formats
		    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		        $uploadOk = 0;
		    }
		    // Check if $uploadOk is set to 0 by an error
		    if ($uploadOk == 0) {
		        echo "Sorry, your file was not uploaded.";
		        // if everything is ok, try to upload file
		    } else {
		        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		            $q = "UPDATE `facebook_users` SET `profile_image`='$target_file' WHERE id=$id";
		            $result = mysqli_query($con, $q);

		            $q = "SELECT * FROM facebook_users WHERE id=$id";
		            $data = mysqli_query($con, $q);
		            $row = mysqli_fetch_row($data);
		            echo '<img src="' . $row[5] . '" class="img-circle" alt="photo" width="50" height="50">';
		        } else {
		            echo "Sorry, there was an error uploading your file.";
		        }
}}
function requestList($id) {
	$q = "SELECT * FROM facebook_users where id=$id";
	$data = mysqli_query($GLOBALS['con'], $q);
	if (mysqli_num_rows($data) > 0) {
		while ($row = mysqli_fetch_array($data)) {
			$p = '<td>'.$row["first_name"].'</td>
			<td>'.$row["surname"].'</td>
			<td><button onclick="friendStatus('.$row['id'].',2)" class="btn btn-success">accept</button></td>
			<td><button onclick="friendStatus('.$row['id'].',3)" class="btn btn-success">reject</button></td><br>';}
			return $p;
		}
	}

?>