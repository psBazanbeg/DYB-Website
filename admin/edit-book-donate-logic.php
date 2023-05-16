<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    //get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    //previous thumbnail is used to delete the previous image from the image folder
    $pervious_thumbnail_name = filter_var($_POST['pervious_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //SET IS_FEATURED TO 0 IF IT IS UNCHECKED
    $is_featured = $is_featured == 1 ?: 0;

    //check for valid inputs
    if(!$title){
        $_SESSION['edit-book-error'] = "could not update book. Invalid form input on edit book page";
    }elseif(!$category_id){
        $_SESSION['edit-book-error'] = "could not update book. Invalid form input on edit book page";
    }elseif(!$body){
        $_SESSION['edit-book-error'] = "could not update book. Invalid form input on edit book page";
    }
    else{
        //delete the existing thumbnail and save the updated thumbnail
        if($thumbnail['name']){
            $pervious_thumbnail_path = '../images/' . $pervious_thumbnail_name;
            if($pervious_thumbnail_path){
                unlink($pervious_thumbnail_path);
            }

            //work on new thumbnail
            //rename image
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            //make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);

            if(in_array($extension, $allowed_files)){
                //make sure file size is not too large (1mb+)
                if($thumbnail['size'] < 2000000){
                    //upload image
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-book-error'] = 'File size should be less than 2Mb';
                }
            }
            else{
                $_SESSION['edit-book-error'] = 'File formate should be png, jpg or jpeg';
            }
        }
    }

    if($_SESSION['edit-book-error']){
        //redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'admin/manage-book-index.php');
        die();
    }
    else{
        //set i_featured of all books to 0 if is_featured fpr this book is 1
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE books SET is_featured=0";
            $zero_all_is_featured_redult = mysqli_query($connection, $zero_all_is_featured_query);
        }

        //set thumbnai name if a new one was uploaded, else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $pervious_thumbnail_name;
        
        $query = "UPDATE books SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', 
        category_id=$category_id, is_featured=$is_featured WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
    }

    if(!mysqli_errno($connection)){
        $_SESSION['edit-book-success'] = "Book is successfully updated";
    }

}
header('location: ' . ROOT_URL . 'admin/manage-book-index.php');
die();