<?php
include '../partials/header.php';

//get back from data if there was a registration error
$fullname = $_SESSION['add-user-data']['fullname'] ?? null;
$address = $_SESSION['add-user-data']['address'] ?? null;
$contact = $_SESSION['add-user-data']['contact']?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

//delete sign up data session
unset($_SESSION['add-user-data']);
?>


    <!--FORM SECTION-->

        <section class="form-section">
            <div class="container form-section-container">
                <h2>Add User</h2>
                
                <?php if(isset($_SESSION['add-user'])) : ?>
                    <div class="alert-message error">
                        <p>
                            <?= $_SESSION['add-user']; 
                                unset($_SESSION['add-user']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

                <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="text" name="fullname" value="<?= $fullname ?>" placeholder="Full Name">
                    <input type="text" name="address" value="<?= $address ?>" placeholder="Address">
                    <input type="text" name="contact" value="<?= $contact ?>" placeholder="Contact Number">
                    <input type="text" name="email" value="<?= $email ?>" placeholder="Email Address">
                    <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
                    <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">

                    <select name="userrole" class="my-selection ">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                
                    <div class="form-control">
                        <label for="avtar">User Avatar</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    
                    <button type="submit" name="submit" class="btn">add user</button>
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


        
<?php
include '../partials/footer.php'
?>