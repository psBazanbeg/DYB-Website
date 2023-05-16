<?php
require 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project with php my admin</title>

    <link rel="stylesheet" href="./css/style.css">

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
                <li><a href="<?= ROOT_URL ?>#top">Home</a></li>
                <li><a href="<?= ROOT_URL ?>#service-section">Services</a></li>

                <li><a>About</a>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>#intro-section">About Us</a></li>
                        <li><a href="<?= ROOT_URL ?>#Achievement-section">Achievements</a></li>
                    </ul>
                </li>
                
                <li><a href="<?= ROOT_URL ?>#Contact-section">Contact</a></li>
                <li><a href="<?= ROOT_URL ?>Sign_in.php" class="btn1">Sign in</a></li>
            </ul>

            <button id="open-menu-btn"><i class="barbtn uil uil-bars"></i></button> 
            <button id="close-menu-btn"><i class="crossbtn uil uil-multiply"></i></button>
        </div>
    </nav>
    <!--END OF THE NAVIGATION BAR-->