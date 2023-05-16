<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1){
        $avatar_name = $user['avatar']; 
        $avatar_path = '../images/' . $avatar_name;

        if($avatar_path){
            unlink($avatar_path);
        }
    }

    //fetch all the thumbnails of user's books and delete them
    $thumbnail_query = "SELECT thumbnail FROM books WHERE donor_id=$id";
    $thumbnail_result = mysqli_query($connection, $thumbnail_query);

    if(mysqli_num_rows($thumbnail_result) > 0){
        while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
            $thumbnail_path = '../image/' . $thumbnail['thumbnail'];
            //delete tuhmbnail from the images folder if it is exist
            if($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }






    
    //delete user from the database
    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_query_result = mysqli_query($connection, $delete_user_query);

    if(mysqli_errno($connection)){
        //redirect to sign in page with success message
        $_SESSION['delete-user-error'] = "Fail to delete user";
    }
    else{
        $_SESSION['delete-user-success'] = "{$user['fullname']} has been deleted successfully!";           
    }
}

header('location: ' . ROOT_URL . '/admin/manage-user.php');
die();

