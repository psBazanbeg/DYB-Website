<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch category from database
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_assoc($result);
    }
}
else{
    header('location: ' . ROOT_URL . 'admin/manage-category.php');
    die();
}

?>


    <!--FORM SECTION-->

        <section class="form-section" >
            <div class="container form-section-container">
                <h2>Edit Category</h2>

                <?php if(isset($_SESSION['edit-category-error'])) : ?>
                    <div class="alert-message error">
                        <p>
                            <?= $_SESSION['edit-category-error']; 
                                unset($_SESSION['edit-category-error']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

                <form action="<?= ROOT_URL ?>admin/edit-book-category-logic.php" method="POST">
                    <input type="hidden" name="id" value="<?= $category['id'] ?>">
                    <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Title">
                    <textarea rows="4" name="description" placeholder="Description"><?= $category['description'] ?></textarea>
                    <button type="submit" name="submit" class="btn">Update Category</button>
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


                
<?php
include '../partials/footer.php'
?>