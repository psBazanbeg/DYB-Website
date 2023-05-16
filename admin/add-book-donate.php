<?php
include 'partials/header.php';

//fetch categories frrom the database 
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

//get back form data if the was an error 
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

//delete form data session
unset($_SESSION['add-post-data']);
?>



    <!--FORM SECTION-->

    <section class="form-section">
            <div class="container form-section-container">
                <h2>Donate Book</h2>

                <?php if(isset($_SESSION['add-book-error'])) : ?>
                    <div class="alert-message error">
                        <p>
                            <?= $_SESSION['add-book-error']; 
                                unset($_SESSION['add-book-error']);
                            ?>
                        </p>
                    </div>

                <?php elseif(isset($_SESSION['add-book-success'])) : ?>
                    <div class="alert-message success">
                        <p>
                            <?= $_SESSION['add-book-success']; 
                                unset($_SESSION['add-book-success']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

                <form action="<?= ROOT_URL ?>admin/add-book-donate-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="text" value="<?= $title ?>" name="title" placeholder="Title">

                    <!--get the database categories into combo box in this page-->
                    <select class="my-selection" name="category">
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                            <option value="<?= $category['id'] ?>"><?=  $category['title'] ?></option>
                        <?php endwhile?>
                    </select>
                    <!-------------------------------------------->

                    <textarea rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
                    
                    <!--only admin can change a book as featured-->
                    <?php if(isset($_SESSION['user_is_admin'])) : ?>
                        <div class="form-control inline">
                            <input type="checkbox" name="is_featured" id="is_featured" checked>
                            <label for="is_featured">Featured</label>
                        </div>
                    <?php endif ?>
                    <!-------------------------------------------->

                    <div class="form-control">
                        <label for="thumbnail">Add Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail">
                    </div>
                    
                    <button type="submit" name="submit" class="btn">Donate</button>
                </form>
            </div>
    </section>

    <!--END OF THE FORM SECTION-->


        
<?php
include '../partials/footer.php'
?>