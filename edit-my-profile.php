<?php
include 'partials/header.php';
?>



    <!--FORM SECTION-->

        <section class="form-section">
            <div class="container form-section-container">
                <h2>Edit Profile</h2>
                <div class="alert-message error">
                    <p>This is an success alert-message</p>
                </div>
                <form action="" enctype="multipart/form-data">
                    <input type="text" placeholder="Full Name">
                    <input type="text" placeholder="Address">
                    <input type="text" placeholder="Contact Number">
                    <input type="text" placeholder="Email Address">
                    <input type="password" placeholder="Create New Password">
                    <input type="password" placeholder="Confirm Password">

                    <!--
                    <select class="my-selection ">
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                    -->

                    <div class="form-control">
                        <label for="avtar">User Avatar</label>
                        <input type="file" id="avatar">
                    </div>
                    
                    <button type="submit" class="btn">Update</button>
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


        
<?php
include 'partials/footer.php'
?>