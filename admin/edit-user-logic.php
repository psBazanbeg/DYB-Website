<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    //get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    //check for valid inputs
    if(!$fullname){
        $_SESSION['edit-user-error'] = "Invalid form input on edit page";
    }else{
        $query = "UPDATE users SET fullname='$fullname', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            //Redirecct to the manage-user page
            $_SESSION['edit-user-error'] = "Fail to Update user";
        }
        else{
            $_SESSION['edit-user-success'] = "User $fullname updated successfully!";        
        }
    }
}
header('location: ' . ROOT_URL . 'admin/manage-user.php');
die();