<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    //get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['add-category-error'] = "Enter title";
    }
    elseif(!$description){
        $_SESSION['add-category-error'] = "Enter description";
    }

    //redirect back to the add-category page with form data if there was an invalide input
    if(isset($_SESSION['add-category-error'])){
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    }else{
        //insert into database if there was no any error
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);
        if(mysqli_errno($connection)){
            $_SESSION['add-category-error'] = "Could not add category";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        }else{
            $_SESSION['add-category-success'] = "Category $title added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-category.php');
            die();
        }
    }
}