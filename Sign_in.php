<?php
session_start();
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);

//get back from data if there was a registration error
$fullname = $_SESSION['signup-data']['fullname'] ?? null;
$address = $_SESSION['signup-data']['address'] ?? null;
$contact = $_SESSION['signup-data']['contact']?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

//delete sign up data session
unset($_SESSION['signup-data']);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link rel="stylesheet" href="<?= ROOT_URL?>css/sign_in.css">

    <!--ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!--FLACTION CDN-->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <!--GOOGLE FONTS-MONTSERRAT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">      
        <div class="forms-container">               
            <div class="signin-signup">   

                <!--Login form-->

                <form action="<?= ROOT_URL ?>signin-logic.php" method="POST" class="signin-form">

                    <h2 class="title">Sign in</h2>

                    <?php if (isset($_SESSION['signup-success'])) : ?>
                        <div class="alert-message success">
                            <p>
                                <?= $_SESSION['signup-success']; 
                                unset($_SESSION['signup-success']);
                                ?>
                            </p>
                        </div>

                    <?php elseif (isset($_SESSION['signin'])) : ?>
                        <div class="alert-message error">
                            <p>
                                <?= $_SESSION['signin']; 
                                unset($_SESSION['signin']);
                                ?>
                            </p>
                        </div>

                    <?php endif ?>
                    
                    <div class="input-field">
                        <i class="uil uil-user"></i>
                        <input type="text" name="username_email" value="<?=$username_email?>" placeholder="Email">
                    </div>

                    <div class="input-field">
                        <i class="uil uil-key-skeleton-alt"></i>
                        <input type="password" name="password" value="<?=$password?>" placeholder="Password">
                    </div>
                    
                    <button type="submit" name="submit" class="btn-solid">Log In</button>
                </form>




                <!--Registration form-->

                <form action="<?=ROOT_URL ?>signup-logic.php" class="signup-form" enctype="multipart/form-data" method="POST">
                    <h2 class="title">Sign up</h2>
                    
                    <?php if (isset($_SESSION['signup'])) : ?>
                        <div class="alert-message error">
                            <p>
                                <?= $_SESSION['signup']; 
                                unset($_SESSION['signup']);
                                ?>
                            </p>
                        </div>

                    <?php endif ?>

                    <div class="input-field">
                        <i class="uil uil-user"></i>
                        <input type="text" name="fullname" value="<?= $fullname ?>" placeholder="Full Name">
                    </div>

                    <div class="input-field">
                        <i class="uil uil-location-point"></i>
                        <input type="text" name="address" value="<?= $address ?>" placeholder="Address">
                    </div>

                    <div class="input-field">
                        <i class="uil uil-phone"></i>
                        <input type="text" name="contact" value="<?= $contact ?>" placeholder="Contact Number">
                    </div>

                    <div class="input-field">
                        <i class="uil uil-envelope-edit"></i>
                        <input type="text" name="email" value="<?= $email ?>" placeholder="Email Address">
                    </div>

                    <div class="input-field">
                        <i class="uil uil-lock-alt"></i>
                        <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                    </div>

                    <div class="input-field">
                        <i class="uil uil-key-skeleton-alt"></i>
                        <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
                    </div>

                    <div class="input-field form-control">
                        <i class="uil uil-camera"></i>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    
                    <button type="submit" name="register" class="btn-solid" id="register-btn">Register Now</button>

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <ul class="home-icon">
                    <a href="index.php"><i class="uil uil-estate"></i></a> 
                </ul>             
                <div class="content">  
                    <h2>New here???</h2>
                    <p>
                        Sign up for DYB and find a new way to live your old books by donating and borrowing books.
                    </p>
                    <button class="btn-solid transparent" id="sign-up-btn">Sign Up</button>
                </div>
                <img src="admin/assests/undraw_login_re_4vu2.svg" class="image">
            </div>

            <div class="panel right-panel">
                <ul class="home-icon">
                    <a href="index.php"><i class="uil uil-estate"></i></a> 
                </ul> 
                <div class="content">
                    <h2>One of Us???</h2>
                    <p>
                        Log into your account and make a relationship with books.
                    </p>
                    <button class="btn-solid transparent" id="sign-in-btn">Sign In</button>
                </div>            
                <img src="admin/assests/undraw_welcome_cats_thqn.svg" class="image">
            </div>
        </div>

    </div>

    <script src="./js/sign.js"></script>

</body>
</html>