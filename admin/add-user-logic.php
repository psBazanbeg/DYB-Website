<?php
session_start();
require 'config/database.php';

//get form data if add button was clicked
if(isset($_POST['submit'])){

    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'],  FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    //validate input values
    if(!$fullname){
        $_SESSION['add-user'] = "Please enter your Full Name";
    }elseif(!$address){
        $_SESSION['add-user'] = "Please enter your Address";
    }elseif(!$contact){
        $_SESSION['add-user'] = "Please enter your Contact Number";
    }elseif(!$email){
        $_SESSION['add-user'] = "Please enter your valid Email Address";
    }elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['add-user'] = "Passowrd should be at least 8 characters";
    }elseif(!$avatar['name']){
        $_SESSION['add-user'] = "Please add an Avatar";
    }else{
        //check whether passwords are match
        if($createpassword !== $confirmpassword){
            $_SESSION['add-user'] = "Password does not match";
        }
        else{
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            
            //check whether the username or password already exit
            $user_check_query = "SELECT * FROM users WHERE email = '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['add-user'] = "Email already exist";
            }
            else{
                // work on avatar
                // users can upload avatar with same name, so rename avatar
                $time = time(); //make each image name unique using current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $avatar_name);
                $extension = end($extension);

                if(in_array($extension, $allowed_files)){
                    //make sure file size is not too large (1mb+)
                    if($avatar['size'] < 1000000){
                        //upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    }else{
                        $_SESSION['add-user'] = 'File size should be less than 1.0Mb';
                    }
                }
                else{
                    $_SESSION['add-user'] = 'File formate should be png, jpg or jpeg';
                }
            }
        }
    }

    
    
    //riderect back to Sign_up page if there was any problem
    if(isset($_SESSION['add-user'])){
        //pass data back to Sign_up page
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    }
    else{
        //insert a new user into the users table
        $insert_user_query = " INSERT INTO users (fullname, address, contact, email, password, avatar, is_admin)
         VALUES ('$fullname', '$address', '$contact', '$email', '$hashed_password', '$avatar_name', $is_admin)";

        $insert_user_result = mysqli_query($connection, $insert_user_query);

         if(!mysqli_errno($connection)){
            $_SESSION['add-user-success'] = "New user $fullname added successfully!";
            header('location: ' . ROOT_URL . '/admin/manage-user.php');
            die();
         }
    }

}

else{
    //if register button was not clicked bounce back to the registration page
    header('location: ' .ROOT_URL . 'admin/add-user.php');
    die();
}