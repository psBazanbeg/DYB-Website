<?php
include 'partials/header.php';
?>




    <!--FORM SECTION-->

        <section class="form-section">
            <div class="container form-section-container">
                <h2>Borrow Book</h2>
                
                <form action="" enctype="multipart/form-data">
                    <div class="label-container">
                        <div class="labels">
                            <label for="book-id">Book ID :</label>
                            <input type="text">
                        </div>
                        
                        <div class="labels">
                            <label for="book-title">Book Title :</label>
                            <input type="text">
                        </div>                  
                        
                        <label class="donor-details" for="donor-name">Donor Details</label>
    
                        <div class="labels">
                            <label for="donor-name">Name :</label>
                            <input type="text">
                        </div>
                        
                        <div class="labels">
                            <label for="Donor-address">Address :</label>
                            <input type="text">
                        </div>
    
                        <div class="labels">
                            <label for="Donor-email">Email Address :</label>
                            <input type="text">
                        </div>
                    </div>
                    
                    <p class="note1">
                        Read carefully before borrow :
                        If the distance between you and the book donor is less than 5km, you can get the book yourself by meeting the donor. For that, CLICK "CONTACT DONOR & BORROW" BUTTON and contact the donor by using the email address that the donor has provided. If the distance is greater than 5km, you can ask for the delivery service by CLICKING "BORROW USING DELIVERY SERVICE" BUTTON.
                    </p>
                    <p class="note2">
                        Note : Delivery charges are totally free.
                    </p>
                    <div class="borrow-buttons">
                        <button type="submit" class="btn">Contact Donor & Borrow</button>
                        <button type="submit" class="btn">Borrow Using Delivery Service</button>
                    </div>         
                </form>
            </div>
        </section>

        <!--END OF THE FORM SECTION-->


        
<?php
include 'partials/footer.php'
?>