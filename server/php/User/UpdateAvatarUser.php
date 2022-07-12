<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

//Import connection SQL Server
// require('../connect.php');

//Import metadata database table
$configTableDatabase = require('../configTableDatabase.php');

//Import metadata database
$config = require('../config.php');

//Get name user table
$userTable = $configTableDatabase['UserTable'];

//Get id user from cookie
$cookieUserId = $_COOKIE['user_id'];

# check if image sent
if (isset($_FILES['avatar_image'])) {

    # selected imge name into database
    $mysqlConnectForQuery1 = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
    $sql1 = "SELECT photo FROM `$userTable` WHERE id_user = '$cookieUserId'";
    $prev_photo_sql= mysqli_query($mysqlConnectForQuery1, $sql1);
    $prev_photo = $prev_photo_sql->fetch_assoc();

	# getting image data and store them in var
	$img_name = $_FILES['avatar_image']['name'];
	$img_size = $_FILES['avatar_image']['size']; 
	$tmp_name = $_FILES['avatar_image']['tmp_name'];
	$error    = $_FILES['avatar_image']['error'];

	# if there is not error occurred while uploading
		if ($img_size > 1000000) {
			# error message
			$em = "Вы пытаетесь загрузить файл большого размера!";

			# response array
			$error = array('error' => 1, 'em'=> $em);
		    echo json_encode($error);
		    exit();

		}else {
			# get image extension store it in var
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
			$allowed_exs = array("jpg", "jpeg", "png");
			if (in_array($img_ex_lc, $allowed_exs)) {

				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;

				# crating upload path on root directory
				$img_upload_path = "../../uploads/".$new_img_name;

				# move uploaded image to 'uploads' folder
				move_uploaded_file($tmp_name, $img_upload_path);

                //delete prev photo user
                if($prev_photo['photo'] != 'default.png'){
                    unlink('../../uploads/'.$prev_photo['photo']);
                }

                
				# inserting imge name into database
                $mysqlConnectForQuery = new mysqli($config['HostDatabase'], $config['UserNameInDatabase'], $config['PasswordUserInDatabase'], $config['NameDatabase']);
                $sql = "UPDATE `$userTable` SET photo ='$new_img_name' WHERE id_user = '$cookieUserId'";
                mysqli_query($mysqlConnectForQuery, $sql);
                
                # response array
				$res = array('error' => 0, 'src'=> $new_img_name);

                echo json_encode($res);
			    exit();

			}else {
				# error message
				$em = "Вы пытаетесь загрузить файл недопустимого формата!";

				# response array
				$error = array('error' => 1, 'em'=> $em, 'img' => $_FILES['avatar_image']);
			    echo json_encode($error);
			    exit();
			}
		}

}




?>