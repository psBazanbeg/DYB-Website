<?php
include 'partials/header.php';

//fetch books if id is match

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $books_query = "SELECT * FROM books WHERE category_id=$id ORDER BY date_time DESC" ;
    $books = mysqli_query($connection, $books_query);
}else{
    header('location: ' . ROOT_URL . 'common-page.php');
    die();
}

?>


    <!--HEADER-->

    <header class="category-title">
        <?php 
            //fetch category from categories table using category_id of the book
            $category_id = $id;
            $category_query = "SELECT * FROM categories WHERE id=$id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
        ?>
        <h6><?= $category['title'] ?></h6>
    </header>

    <!--END OF THE HEADER-->


    <!--POST-->
    <section class="posts">
        <div class="container posts-container">
            <?php while($book = mysqli_fetch_assoc($books)) : ?>
                <article class="post">

                    <div class="post-thumbnail">
                        <img src="./images/<?= $book['thumbnail'] ?>">
                    </div>

                <div class="post-info">
                     
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
