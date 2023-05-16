<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT title FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $category = mysqli_fetch_assoc($result);

    $update_query = "UPDATE books SET category_id=12 WHERE category_id=$id";
    $update_result = mysqli_query($connection, $update_query);

    if(!mysqli_errno($connection)){
        //delete user from the database
        $delete_category_query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $delete_category_result = mysqli_query($connection, $delete_category_query);

        $_SESSION['delete-category-success'] = "{$category['title']} category has been deleted successfully!";           
    }

}

header('location: ' . ROOT_URL . '/admin/manage-category.php');
die();

