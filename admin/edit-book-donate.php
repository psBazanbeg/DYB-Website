<?php
include 'partials/header.php';

//fetch acategories from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);

//fetch book data from the database to the textfields if id is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM books WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $book = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL . 'admin/manage-book-index.php');
    die();
}

?>


    <!--FORM SECTION-->

        <section class="form-section">
            <div class="container form-section-container">
                <h2>Edit Book</h2>

                <form action="<?= ROOT_URL ?>admin/edit-book-donate-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id" value="<?= $book['id'] ?>">
                    <input type="hidden" name="previous_thumbnail_name" value="<?= $book['thumbnail'] ?>">
                    <input type="text" name="title" value="<?= $book['title'] ?>" placeholder="Title">
                    <select name="category" class="my-selection">
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                        <?php endwhile ?>
                    </select>
                    <textarea rows="10" name="body" placeholder="Body"><?= $book['body'] ?></textarea>
                    
                    <!--only admin can change a book as featured-->
                    <?php if(isset($_SESSION['user_is_admin'])) : ?>
                        <div class="form-control inline">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                            <label for="is_featured">Featured</label>
                        </div>
                        <?php endif ?>
                    <!-------------------------------------------->

                    <div class="form-control">
                        <label for="thumbnail">Change Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail">
                    </div>
                    
                    <button type="submit" name="submit" class="btn">Edit Donattion</button>
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


        
<?php
include '../partials/footer.php'
?>