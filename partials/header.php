<?php
require 'config/database.php';

//fetch current user from the database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Category</title>

    <link rel="stylesheet" href="<?= ROOT_URL ?>css/add-section.css">

    <!--ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!--FLACTION CDN-->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <!--GOOGLE FONTS-MONTSERRAT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    
    <!--NAVIGATION BAR-->
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>index.php"><h6>DYB</h6></a>
            <h1>Donate Your Book</h1>
            
            <ul class="nav__menu">
                <li><a href="<?= ROOT_URL ?>common-page.php" class="nav-btn">Home</a></li>

                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav-profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'images/' . $avatar['avatar']?>">
                        </div>
                        <ul>
                            <li><a href="<?= ROOT_URL ?>admin/manage-book-index.php">Dashboard</a></li>
                            <li><a href="<?= ROOT_URL ?>logout.php">Log out</a></li>
                        </ul>
                    </li>
                <?php else : ?>
                    <li><a href="<?= ROOT_URL ?>Sign_in.php" class="nav-btn">Sign in</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <!--END OF THE NAVIGATION BAR-->