<?php
include 'partials/header.php';

//fetch users from database but not current user
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);
?>


    <!--DASHBOARD-->
    <section class="dashboard">
        <?php if (isset($_SESSION['add-category-success'])) : ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['add-category-success']; 
                        unset($_SESSION['add-category-success']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['add-category-error'])) : ?>
            <div class="alert-message error container">
                <p>
                    <?= $_SESSION['add-category-error'];
                        unset($_SESSION['add-category-error']);
                    ?>
                </p>
            </div>   
            
        <?php elseif(isset($_SESSION['edit-category-error'])) : ?>
            <div class="alert-message error container">
                <p>
                    <?= $_SESSION['edit-category-error'];
                        unset($_SESSION['edit-category-error']);
                    ?>
                </p>
            </div>   

        <?php elseif(isset($_SESSION['edit-category-success'])) : ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['edit-category-success'];
                        unset($_SESSION['edit-category-success']);
                    ?>
                </p>
            </div>   

        <?php elseif(isset($_SESSION['delete-category-success'])) : ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['delete-category-success'];
                        unset($_SESSION['delete-category-success']);
                    ?>
                </p>
            </div>   
        <?php endif ?>

        <div class="container dashboard-container">
            <button id="show-sidebar-btn" class="sidebar-toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide-sidebar-btn" class="sidebar-toggle"><i class="uil uil-angle-left-b"></i></button>
            <aside>
                <ul>
                    <li>
                        <a href="add-book-donate.php"><i class="uil uil-edit"></i>
                            <h7>Add Book</h7>
                        </a>
                    </li>
                    
                    <li>
                        <a href="manage-book-index.php"><i class="uil uil-books"></i>
                            <h7>Manage Book</h7>
                        </a>
                    </li>

                    <?php if(isset($_SESSION['user_is_admin'])): ?>

                        <li>
                            <a href="add-user.php"><i class="uil uil-user-plus"></i>
                                <h7>Add User</h7>
                            </a>
                        </li>

                        <li>
                            <a href="manage-user.php"><i class="uil uil-user-arrows"></i>
                                <h7>Manage User</h7>
                            </a>
                        </li>

                        <li>
                            <a href="add-category.php"><i class="uil uil-book-medical"></i>
                                <h7>Add Category</h7>
                            </a>
                        </li>

                        <li>
                            <a href="manage-category.php" class="active"><i class="uil uil-clipboard-notes"></i>
                                <h7>Manage Category</h7>
                            </a>
                        </li>
                    <?php endif ?>
                
                </ul>
            </aside>


            <main>
                <h2>Manage Category</h2>
                <?php if(mysqli_num_rows($categories) > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                                <tr>
                                    <td><?= $category['title'] ?></td>
                                    <td><a href="<?= ROOT_URL ?>admin/edit-book-category.php?id=<?= $category['id'] ?>" class="btn sm bg">Edit</a></td>
                                    <td><a href="<?= ROOT_URL ?>admin/delete-book-category.php?id=<?= $category['id'] ?>" class="btn sm">Delete</a></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>

                    </table>
                    <?php else : ?> 
                        <div class="alert-message error container"><?= "No category found" ?></div>
                <?php endif ?>
            </main>


        </div>
    </section>

    <!--END OF THE DASHBOARD-->


        
<?php
include '../partials/footer.php'
?>