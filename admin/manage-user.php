<?php
include 'partials/header.php';

//fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
?>


    <!--DASHBOARD-->
    <section class="dashboard">
            <?php if (isset($_SESSION['add-user-success'])) : ?>
                <div class="alert-message success container">
                    <p>
                        <?= $_SESSION['add-user-success']; 
                            unset($_SESSION['add-user-success']);
                        ?>
                    </p>
                </div>

            <?php elseif (isset($_SESSION['edit-user-success'])) : ?>
                <div class="alert-message success container">
                    <p>
                        <?= $_SESSION['edit-user-success']; 
                            unset($_SESSION['edit-user-success']);
                        ?>
                    </p>
                </div>  
                
            <?php elseif (isset($_SESSION['edit-user-error'])) : ?>
                <div class="alert-message error container">
                    <p>
                        <?= $_SESSION['edit-user-error']; 
                            unset($_SESSION['edit-user-error']);
                        ?>
                    </p>
                </div>

            <?php elseif (isset($_SESSION['delete-user-success'])) : ?>
                <div class="alert-message success container">
                    <p>
                        <?= $_SESSION['delete-user-success']; 
                            unset($_SESSION['delete-user-success']);
                        ?>
                    </p>
                </div>  
                
            <?php elseif (isset($_SESSION['delete-user-error'])) : ?>
                <div class="alert-message error container">
                    <p>
                        <?= $_SESSION['delete-user-error']; 
                            unset($_SESSION['delete-user-error']);
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

                    <?php if(isset($_SESSION['user_is_admin'])) : ?>

                        <li>
                            <a href="add-user.php"><i class="uil uil-user-plus"></i>
                                <h7>Add User</h7>
                            </a>
                        </li>

                        <li>
                            <a href="manage-user.php"  class="active"><i class="uil uil-user-arrows"></i>
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
                <h2>Manage User</h2>
                <?php if(mysqli_num_rows($users) > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Admin</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while($user = mysqli_fetch_assoc($users)) : ?>
                                <tr>
                                    <td><?= $user['fullname'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm bg">Edit</a></td>
                                    <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm">Delete</a></td>
                                    <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="alert-message error container"><?= "No users found" ?></div>
                <?php endif ?>
            </main>


        </div>
    </section>

    <!--END OF THE DASHBOARD-->


    <!--FOOTER-->

    <footer>
            <div class="container footer__container">
                <div class="footer__1">
                    <a href="#top" class="footer__logo"><h7>DYB</h7></a>
                    <p>© 2022. DYB is a registered charity in Sri Lanka (no 202918). DYB GB is a member of the national confederation DYB.</p>
                </div>
    <!--
                <div class="footer__2">
                    <h7>Permalinks</h7>
                    <ul>
                        <li><a href="#top">Home</a></li>
                        <li><a href="#service-section">Services</a></li>
                        <li><a href="#faqs-section">FAQs</a></li>
                        <li><a href="#intro-section">About Us</a></li>
                        <li><a href="#Achievement-section">Achievements</a></li>                  
                        <li><a href="#Contact-section">Contact</a></li>
                    </ul>
                </div>
    -->
                <div class="footer__3">
                    <h7>Privacy</h7>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Refund Policy</a></li>
                    </ul>
                </div>
    
                <div class="footer__4">
                    <h7>Contact Us</h7>
                    <div>
                        <li>
                            <i class="uil uil-phone-times"></i>
                            <p>+94 767058945</p>
                        </li>
                        <li>
                            <i class="uil uil-envelope"></i>
                            <p>prasa98@gmail.com</p>
                        </li>                   
                    </div>
                    
                    <ul class="footer__socials">
                        <li>
                            <a href="https://www.facebook.com"><i class="uil uil-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com"><i class="uil uil-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com"><i class="uil uil-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com"><i class="uil uil-linkedin-alt"></i></a>
                        </li>
                    </ul>
                </div>
            </div>        
    </footer>
    
    <!--END OF THE FOOTER--> 


    <script src="../js/common-page.js"></script>

</body>
</html>