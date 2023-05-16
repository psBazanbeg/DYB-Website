<?php
require 'config/database.php';

//fetch featured book from the database
$featured_query = "SELECT * FROM books WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);


//fetch current user from the database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}

//fetch only 9 books from book table
$query = "SELECT * FROM books ORDER BY date_time DESC LIMIT 9";
$books = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Common Page</title>

    <link rel="stylesheet" href="./css/common-page.css">

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
            <a href="index.php"><h6>DYB</h6></a>
            <h1>Donate Your Book</h1>
            
            <ul class="nav__menu">
                <li><a href="index.php" class="nav-btn">Home</a></li>

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


    <!--SEARCH BAR-->
    <section class="search-bar">
        <form action="" class="container search-bar-container">
            <div>
                <i class="uil uil-search-alt"></i>
                <input type="search" placeholder="Search">
            </div>
            <button type="submit" class="btn">Go</button>
        </form>
    </section>
    <!--END OF THE NAVIGATION BAR-->

    <!--show featured book if there is any-->
    <!--FEATURED POST-->
    <?php if(mysqli_num_rows($featured_result) == 1) : ?>
        <Section class="featured">
            <div class="container featured-container">
                <div class="post-thumbnail">
                    <img src="./images/<?= $featured['thumbnail'] ?>">
                </div>
                <div class="post-info">
                    <?php 
                        //fetch category from categories table using category_id of the book
                        $category_id = $featured['category_id'];
                        $category_query = "SELECT * FROM categories WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                        $category_title = $category['title'];
                    ?>
                    <a href="<?= ROOT_URL ?>book-category.php?id=<?= $featured['category_id'] ?>" class="category-btn"><?= $category['title'] ?></a>
                    <h2 class="post-title">
                        <a href="<?= ROOT_URL ?>single-book.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a>
                    </h2>
                    <p class="post-body"><?= substr($featured['body'], 0, 500) ?>...</p>
                    <div class="post-author">
                        <?php
                            //fetch donor from thr users table unsing dinir_id
                            $donor_id = $featured['donor_id'];
                            $donor_query = "SELECT * FROM users WHERE id=$donor_id";
                            $donor_result = mysqli_query($connection, $donor_query);
                            $donor = mysqli_fetch_assoc($donor_result);
                        ?>
                        <div class="post-author-avatar">
                            <img src="./images/<?= $donor['avatar'] ?>">
                        </div> 
                        <div class="post-author-info">
                            <h4>By: <?= $donor['fullname'] ?> </h4>
                            <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </Section>
    <?php endif ?>

    <!--END OF THE FEATURED POST-->


    <!--POST-->
    <section class="posts">
        <div class="container posts-container">
            <?php while($book = mysqli_fetch_assoc($books)) : ?>
                <article class="post">

                    <div class="post-thumbnail">
                        <img src="./images/<?= $book['thumbnail'] ?>">
                    </div>

                <div class="post-info">
                    <?php 
                        //fetch category from categories table using category_id of the book
                        $category_id = $book['category_id'];
                        $category_query = "SELECT * FROM categories WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);
                    ?>
                    <a href="<?= ROOT_URL ?>book-category.php?id=<?= $book['category_id'] ?>" class="category-btn"><?= $category['title'] ?></a>
                    
                    <h4 class="post-title">
                        <a href="<?= ROOT_URL ?>single-book.php?id=<?= $book['id'] ?>">
                            <?= $book['title'] ?>
                        </a>
                    </h4>
                    <p class="post-body">
                        <?= substr($book['body'], 0, 200) ?>...
                    </p>
                    <div class="post-author">
                        <?php 
                            //fetch category from categories table using category_id of the book
                            $donor_id = $book['donor_id'];
                            $donor_query = "SELECT * FROM users WHERE id=$donor_id";
                            $donor_result = mysqli_query($connection, $donor_query);
                            $donor = mysqli_fetch_assoc($donor_result);
                        ?>
                        <div class="post-author-avatar">
                            <img src="./images/<?= $donor['avatar'] ?>">
                        </div>
                        <div class="post-author-info">
                            <h4>By: <?= $donor['fullname'] ?> </h4>
                            <small><?= date("M d, Y - H:i", strtotime($book['date_time'])) ?></small>
                        </div>
                    </div>
                </div>
                </article>
            <?php endwhile ?>
        </div>
    </section>
    <!--END OF THE POST-->

    <!--CATEGORY BTN-->

    <section class="category-buttons">
        <div class="container category-buttons-container">
            <?php 
                $all_categories_query = "SELECT * FROM categories";
                $all_categories = mysqli_query($connection, $all_categories_query);
            ?>
            <?php while($category = mysqli_fetch_assoc($all_categories)) : ?>
                <a href="<?= ROOT_URL ?>book-category.php?id=<?= $category['id'] ?>" 
                class="category-btn"><?= $category['title'] ?></a>
            <?php endwhile ?>
        </div>
    </section>

    <!--END OF THE CATEGORY BTN-->


        
<?php
include 'partials/footer.php'
?>