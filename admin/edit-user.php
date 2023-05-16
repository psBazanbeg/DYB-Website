<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}
else{
    header('location: ' . ROOT_URL . 'admin/manage-user.php');
    die();
}
?>


    <!--FORM SECTION-->

        <section class="form-section">
            <div class="container form-section-container">
                <h2>Edit User</h2>
           
                <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" value="<?= $user['id'] ?>" name="id">
                    <input type="text" name="fullname" value="<?= $user['fullname'] ?>" placeholder="Full Name">
                    
                    <select class="my-selection " name="userrole">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
        
                    <button type="submit" name="submit" class="btn">Update</button>
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


        
<?php
include '../partials/footer.php'
?>