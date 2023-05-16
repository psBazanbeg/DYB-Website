<?php
include 'partials/header.php';

//fetch book from the database if id is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM books WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $book = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL . 'common-page.php');
    die();
}

?>


    <!--SINGLE POST-->

    <section class="single-post">
        <div class="container single-post-container">
            <h6 class="title"><?= $book['title'] ?></h6>

            <?php
            $donor_id = $book['donor_id'];
                $donor_query = "SELECT * FROM users WHERE id=$donor_id";
                $donor_result = mysqli_query($connection, $donor_query);
                $donor = mysqli_fetch_assoc($donor_result);
            ?>
            <div class="post-author">
                <div class="post-author-avatar">
                    <img src="./images/<?= $donor['avatar'] ?>">
                </div>
                <div class="post-author-info">
                    <h4>By: <?= $donor['fullname'] ?> </h4>
                    <small><?= date("M d, Y - H:i", strtotime($book['date_time'])) ?></small>
                </div>
            </div>
            <div class="single-post-thumbnail">
                <img src="./images/<?= $book['thumbnail'] ?>">
            </div>
            <p><?= $book['body'] ?></p>

            <button class="btn borrow-btn" onclick="window.location.href='borrow-book.php'" id="borrow_btn">Wish to Borrow</button>
        </div>
    </section>


    <!--END OF THE SINGLE POST-->



        
<?php
include 'partials/footer.php'
?>