<?php
session_start();
$con = mysqli_connect('localhost', 'root', 'gurunanak');
mysqli_select_db($con, 'mydb');
if (isset($_POST['photo'])) {
    $x = $_SESSION["uid"];
    $q = "SELECT * FROM facebook_users WHERE id=$x";
    $data = mysqli_query($con, $q);
    $row = mysqli_fetch_row($data);
    echo '<img src="' . $row[5] . '" class="img-circle" alt="photo" width="30" height="30">';
}
if (isset($_POST['show_Friend'])) {
    $x = $_SESSION["uid"];
    $q = "SELECT *  FROM `friend_requests` WHERE (from_id=$x OR to_id=$x ) && friend=1";
    $data = mysqli_query($con, $q);
    $p = '';
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_array($data)) {
            $p .= '<tr>' . friendList(($row["from_id"] == $x) ? $row["to_id"] : $row["from_id"]) . '</tr><br>';
        }
    }
    echo $p;
    die(mysqli_error($con));
}

if (isset($_POST['accept_id'])) {

    $q = "UPDATE `friend_requests` SET `status`=0,`friend`=1 WHERE from_id='$_POST[accept_id]'";
    mysqli_query($con, $q);
    //die(mysqli_error($con));


}
if (isset($_POST['reject_id'])) {

    $q = "UPDATE `friend_requests` SET `status`=0,`friend`=0 WHERE from_id='$_POST[reject_id]'";
    mysqli_query($con, $q);
    //die(mysqli_error($con));


}


if (isset($_POST['from_id'])) {
    $x = $_SESSION["uid"];
    $q = "SELECT *  FROM `friend_requests` WHERE to_id=$x && status=1";
    $data = mysqli_query($con, $q);
    $p = '';
    if (mysqli_num_rows($data) > 0) {

        while ($row = mysqli_fetch_array($data)) {
            $p .= '<tr> <td>' . userList($row["from_id"]) . '</td> ';
        }
        echo $p;
    }
    die(mysqli_error($con));
}


if (isset($_POST['to_id'])) {
    $x = $_SESSION["uid"];

    $q = "INSERT INTO `friend_requests`(`from_id`, `to_id`, `status`) VALUES ('$x','$_POST[to_id]','1' )";
    mysqli_query($con, $q);
    //die(mysqli_error($con));
}

if (isset($_POST['search'])) {
    $x = $_SESSION["uid"];
    $srch = $_POST['search'];

    $q = "SELECT * FROM `facebook_users` where first_name LIKE '%$srch%'";
    $data = mysqli_query($con, $q);
    //$row=mysqli_fetch_row($data);
    //echo $row[2];
    $p = '';
    if (mysqli_num_rows($data) > 0) {

        while ($row = mysqli_fetch_array($data)) {

            $p .= '
      <tr>
        <td>' . $row["first_name"] . '</td>
       <td>' . $row["surname"] . '</td>
       <td><button onclick="addFriend(' . $row['id'] . ')" class="btn btn-success">Add Friend</button></td>
      </tr><br>
     
   ';
        }
        // die(mysqli_error($con));
        echo $p;
    }
}


if (isset($_POST['id'])) {
    $q = "SELECT * FROM `facebook_users` where id='$_POST[id]')";
    $data = mysqli_query($con, $q);
    //$row=mysqli_fetch_row($data);
    //echo $row[2];

    if (mysqli_num_rows($data) > 0) {

        while ($row = mysqli_fetch_array($data)) {

            $p = '
      
        <td>' . $row["first_name"] . '</td>
       <td>' . $row["surname"] . '</td>
       
      <br>';
        }
        // die(mysqli_error($con));
        return $p;
    }
}

/*if(!empty($_POST['sign_in'])){
		$name=$_POST['login_id'];
		$q = "SELECT * FROM facebook_users WHERE login_id='$name'";
		$data=mysqli_query($con,$q);   
		$row=mysqli_fetch_row($data);
		  if($row[2]=$name && $row[4]==$_POST['password']){
		  	header('Location: signIn.php');
		  }else{
		  	echo "enter the correct email phone or password";
		  	header('Location: index.php');
		  }


		    echo $row[1];

}  */

if (isset($_POST['readPost'])) {
    $q = "SELECT  * FROM `user_posts` ORDER BY post_id desc";
    $data = mysqli_query($con, $q);
    $p = '';
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_array($data)) {
            $p .= '<tr> <td>' . $row["post"] . '</td></tr><br>';
        }
        echo $p;
    }
}
if (isset($_POST['userPost'])) {
    $x = $_SESSION["uid"];
    $q = "INSERT INTO `user_posts`(`user_id`, `post`) VALUES ('$x','$_POST[userPost]')";
    mysqli_query($con, $q);
}


if (!empty($_POST['log_up'])) {

    //$q="INSERT INTO facebook_users (first_name, surname, login_id, password) VALUES ('$_POST[first_name]','$_POST[surname]','$_POST[login_id]','$_POST[password]')";
    //echo $_POST['first_name'];
    //echo $_POST['surname'];echo $_POST['login_id'];echo $_POST['conform_password'];
    if (!empty($_POST['first_name']) && !empty($_POST['surname']) && !empty($_POST['user_id']) && !empty($_POST['password'])) {
        if ($_POST['conform_password'] == $_POST['password']) {

            $q = "INSERT INTO `facebook_users`( `first_name`, `surname`, `user_id`, `password`) VALUES ('$_POST[first_name]','$_POST[surname]','$_POST[user_id]','$_POST[password]')";
            mysqli_query($con, $q);
            // die(mysqli_error($con));

            header("Location: index.php");
        } else {
            echo "plz enter the password";
        }
    } else {
        echo "plz enter all field";
    }
}

function userList($x) {

    $q = "SELECT * FROM facebook_users where id=$x ";
    $data = mysqli_query($GLOBALS['con'], $q);
    //$row=mysqli_fetch_row($data);
    //echo $row[2];

    if (mysqli_num_rows($data) > 0) {

        while ($row = mysqli_fetch_array($data)) {

            $p = '
      
        <td>' . $row["first_name"] . '</td>
       <td>' . $row["surname"] . '</td>
        <td><button onclick="accept(' . $row['id'] . ')" class="btn btn-success">accept</button></td>
       <td><button onclick="reject(' . $row['id'] . ')" class="btn btn-success">reject</button></td>
      <br>';
        }
        // die(mysqli_error($con));
        return $p;
    }
}


function friendList($x) {

    $q = "SELECT * FROM facebook_users where id=$x ";
    $data = mysqli_query($GLOBALS['con'], $q);
    //$row=mysqli_fetch_row($data);
    //echo $row[2];
    $p = '';
    if (mysqli_num_rows($data) > 0) {

        while ($row = mysqli_fetch_array($data)) {

            $p .= '
      
        <td>' . $row["first_name"] . '</td>
       <td>' . $row["surname"] . '</td>
       
       
      <br>';
        }
        // die(mysqli_error($con));
        return $p;
        die(mysqli_error($con));
    }
}


if (isset($_FILES["fileToUpload"]["name"])) {

    $x = $_SESSION["uid"];


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

            $q = "UPDATE `facebook_users` SET `profile_image`='$target_file' WHERE id=$x";
            $result = mysqli_query($con, $q);

            $q = "SELECT * FROM facebook_users WHERE id=$x";
            $data = mysqli_query($con, $q);
            $row = mysqli_fetch_row($data);
            echo '<img src="' . $row[5] . '" class="img-circle" alt="photo" width="30" height="30">';
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}


?>