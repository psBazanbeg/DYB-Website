<?php
include 'partials/header.php';

//fetch book data of the current logged donor only from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM books WHERE donor_id = $current_user_id ORDER BY id DESC";
$books = mysqli_query($connection, $query);
?>


    <!--DASHBOARD-->
    <section class="dashboard">

        <?php if (isset($_SESSION['add-book-success'])) : ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['add-book-success']; 
                        unset($_SESSION['add-book-success']);
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['edit-book-success'])) : ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['edit-book-success']; 
                        unset($_SESSION['edit-book-success']);
                    ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['edit-book-error'])) : ?>
            <div class="alert-message error container">
                <p>
                    <?= $_SESSION['edit-book-error']; 
                        unset($_SESSION['edit-book-error']);
                     ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-book-success'])) : ?>
            <div class="alert-message success container">
                <p>
                    <?= $_SESSION['delete-book-success']; 
                        unset($_SESSION['delete-book-success']);
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
                        <a href="manage-book-index.php" class="active"><i class="uil uil-books"></i>
                            <h7>Manage Book</h7>
                        </a>
                    </li>

                    <?php if(isset($_SESSION['user_is_admin'])) : ?>

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
                            <a href="manage-category.php"><i class="uil uil-clipboard-notes"></i>
                                <h7>Manage Category</h7>
                            </a>
                        </li>                   
                    <?php endif ?>
                </ul>
            </aside>


            <main>
                <h2>Manage Book</h2>
                    <?php if(mysqli_num_rows($books) > 0) : ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while($book = mysqli_fetch_assoc($books)) : ?>
                                    <!--get category title of each book from category table-->
                                    <?php 
                                        $category_id = $book['category_id'];
                                        $category_query = "SELECT title FROM categories WHERE id=$category_id";
                                        $category_result = mysqli_query($connection, $category_query);
                                        $category = mysqli_fetch_assoc($category_result); 
                                    ?>

                                    <tr>
                                        <td><?= $book['title'] ?></td>
                                        <td><?= $category['title'] ?></td>
                                        <td><a href="<?= ROOT_URL ?>admin/edit-book-donate.php?id=<?=$book['id'] ?>" class="btn sm bg">Edit</a></td>
                                        <td><a href="<?= ROOT_URL ?>admin/delete-book-donate.php?id=<?=$book['id'] ?>" class="btn sm">Delete</a></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="alert-message error container"><?= "No book found" ?></div>
                    <?php endif ?>
            </main>


        </div>
    </section>

    <!--END OF THE DASHBOARD-->


        
<?php
include '../partials/footer.php'
?>