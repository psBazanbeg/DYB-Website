<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    //fetch post from database in order to delete the thumbnail from images folder
    $query = "SELECT * FROM books WHERE id=$id";
    $result = mysqli_query($connection, $query);

    //make sure only one book was fetched
    if(mysqli_num_rows($result) == 1){
        $book = mysqli_fetch_assoc($result);
        $thumbnail_name = $book['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if($thumbnail_path){
            unlink($thumbnail_path);
            //delet book from database
            $delete_book_query = "DELETE FROM books WHERE id=$id LIMIT 1";
            $delete_book_result = mysqli_query($connection, $delete_book_query);

            if(!mysqli_error($connection)){
                $_SESSION['delete-book-success'] = "Book is deleted successfully";
            }
        }
    }
}
header('location: ' . ROOT_URL . 'admin/manage-book-index.php');
die();