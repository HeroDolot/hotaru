<?php
// Includes
include '../includes/header.php';
// Components
include '../components/navbar.php';
include '../connection.php';
?>

<div class="container-fluid py-5 p-5 d-flex justify-content-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bolder fs-5">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inquiry</li>
        </ol>
    </nav>
</div>

<section class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="background-color: #f3f3f3;">
                <div class="card-header fw-bolder fs-3">
                    Inquire
                </div>
                <div class="card-body">
                    <form action="../controller/inquiry_conn.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="clientEmail" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputGroup1" name="clientName" placeholder="Name" required>
                            <label for="floatingInputGroup1">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputGroup1" name="clientNumber" placeholder="Contact Number" required>
                            <label for="floatingInputGroup1">Contact Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="clientRegion" aria-label="Floating label select example" required>
                                <option selected disabled>Select Region</option>
                                <option value="Kanto">Kanto</option>
                            </select>
                            <label for="floatingSelect">Select Region</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="clientWO" required>
                                <option selected disabled>Select Work Order</option>
                                <option value="Relocation">Relocation</option>
                                <option value="House Cleaning">House Cleaning</option>
                                <option value="Things Throw">Things Throw</option>
                                <option value="Others">Others</option>
                            </select>
                            <label for="floatingSelect">Select Work Order</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="clientComment" style="height: 100px" required></textarea>
                            <label for="floatingTextarea2">Comments</label>
                        </div>
                        <div class="container m-0">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" style="border: 1px solid black;" required>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            By checking the box, you agree to our data privacy policy, ensuring your data's protection.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="clientInquirySubmit">Submit Inquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include '../includes/footer.php'
?>