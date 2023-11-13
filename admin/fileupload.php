<?php
include './includes/header.php';
include './components/navbar.php';
?>


<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">File Upload</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="card">
        <div class="card-header fw-bolder fs-4">Proof File Upload</div>
        <div class="card-body">
            <form action="">
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="fileUploadTitle" placeholder="fileUploadTitle">
                    <label for="fileUploadTitle">Title</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option selected>Work Order</option>
                        <option value="1">Relocation</option>
                        <option value="2">Cleaning</option>
                        <option value="3">Stuff Throwing</option>
                    </select>
                    <label for="floatingSelect">Work Order Type</label>
                </div>
                <input type="file" name="fileUploadImage" id="" class="form-control">
                <button type="submit" class="btn btn-primary mt-3 col-md-4 col-5">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
include './includes/footer.php';
?>