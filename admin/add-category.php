<?php
include 'partials/header.php';

//get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>


    <!--FORM SECTION-->

        <section class="form-section" >
            <div class="container form-section-container">

                <h2>Add Category</h2>

                <?php if(isset($_SESSION['add-category-error'])) : ?>
                    <div class="alert-message error container">
                        <p>
                            <?= $_SESSION['add-category-error'];
                                unset($_SESSION['add-category-error']);
                            ?>
                        </p>
                    </div>       
                <?php endif ?>

                <form action="<?= ROOT_URL ?>admin/add-category-logic.php"  enctype="multipart/form-data" method="POST">
                    <input type="text" value="<?= $title ?>" name="title" placeholder="Title">
                    <textarea rows="4" value="<?= $description ?>" name="description" placeholder="Description"></textarea>
                    <button type="submit" name="submit" class="btn">Add Category</button>
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


        
<?php
include '../partials/footer.php'
?>