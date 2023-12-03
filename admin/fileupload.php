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
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bolder fs-4">File Upload</div>
                <div class="card-body">
                    <form action="">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                <option selected>Main Blog</option>
                                <option value="1">Sub Main Blog</option>
                                <option value="2">Secondary Blog</option>
                                <option value="3">Promotion</option>
                            </select>
                            <label for="floatingSelect">Select Location</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="fileUploadTitle" placeholder="fileUploadTitle" required>
                            <label for="fileUploadTitle">Title</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" placeholder="Context" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Context</label>
                        </div>
                        <!-- <div class="form-floating mb-3" id="workOrderContainer">
                            <select class="form-select" id="workOrderSelect" aria-label="Floating label select example" required>
                                <option selected disabled>Work Order</option>
                                <option value="1">Relocation</option>
                                <option value="2">Cleaning</option>
                                <option value="3">Stuff Throwing</option>
                            </select>
                            <label for="workOrderSelect">Work Order Type</label>
                        </div> -->
                        <!-- <div id="fileUploadDescriptionContainer"></div> -->
                        <div class="form-floating mb-3">
                            <!-- Image input for manual uploading -->
                            <input type="file" class="form-control" name="fileUploadImage" id="fileUploadImage" required>
                            <label for="fileUploadImage">Image Upload</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 col-md-4 col-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-hover table-info text-center">
                <thead>
                    <th>Location</th>
                    <th>Title</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Main Blog</td>
                        <td>Main Blog 1</td>
                        <td>
                            <div class="wrapper d-md-flex justify-content-around d-sm-none">
                                <button type="button" class="btn btn-info text-white col-5 col-md-5" data-bs-toggle="modal" data-bs-target="#modal">
                                    <i class="fas fa-pen"></i>
                                </button>

                                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Blog ( SHOW TITLE )</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 form-floating">
                                                    <input type="text" class="form-control" id="fileUploadTitle" placeholder="fileUploadTitle" required>
                                                    <label for="fileUploadTitle">Title</label>
                                                </div>
                                                <div class="mb-3 form-floating">
                                                    <textarea class="form-control" placeholder="Context" id="floatingTextarea2" style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Context</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger col-5 col-md-5">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Secondary</td>
                        <td>Secondary 1</td>
                        <td>
                            <div class="wrapper d-md-flex justify-content-around d-sm-none">
                                <button type="submit" class="btn btn-info text-white col-5 col-md-5">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button type="submit" class="btn btn-danger col-5 col-md-5">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
include './includes/footer.php';
?>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('floatingSelect');
        var titleInput = document.getElementById('fileUploadTitle');
        var workOrderContainer = document.getElementById('workOrderContainer');
        var form = document.querySelector('form');

        var descriptionInput = document.createElement('div');
        descriptionInput.innerHTML = '<div class="mb-3 form-floating">' +
            '<textarea rows="3" class="form-control" id="fileUploadDescription" placeholder="Description" required></textarea>' +
            '<label for="fileUploadDescription">Description</label>' +
            '</div>';

        select.addEventListener('change', function() {
            var descriptionContainer = document.getElementById('fileUploadDescriptionContainer');

            // Remove existing elements
            while (descriptionContainer.firstChild) {
                descriptionContainer.removeChild(descriptionContainer.firstChild);
            }

            if (select.value === '1') { // "Blog" selected
                // Show additional fields
                descriptionContainer.appendChild(descriptionInput.cloneNode(true));
                workOrderContainer.style.display = 'none'; // Hide the "Work Order Type" field
            } else {
                workOrderContainer.style.display = 'block'; // Show the "Work Order Type" field for other options
            }
        });
    });
</script> -->