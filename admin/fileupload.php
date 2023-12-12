<title>Admin Dashboard | File Upload</title>
<?php
session_start();
include("../connection.php");

if (isset($_POST["submit_update"])) {
    // var_dump($_POST);
    $update_location = mysqli_real_escape_string($conn, $_POST["update_location"]);
    $update_title = mysqli_real_escape_string($conn, $_POST["update_title"]);
    $update_description = mysqli_real_escape_string($conn, $_POST["update_description"]);
    $update_image = mysqli_real_escape_string($conn, $_POST["update_image"]);
    $update_date = time();

    mysqli_query($conn, "INSERT INTO updates (update_location,update_title,update_description,update_image,update_date) VALUES('$update_location','$update_title','$update_description','$update_image',$update_date)");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Updates has been upload!");
    } else {
        header("location:./fileupload.php?error=Failed to post updates!");
    }
}

if (isset($_POST["delete_update"])) {
    $update_id = mysqli_real_escape_string($conn, $_POST["update_id"]);
    mysqli_query($conn, "DELETE FROM updates WHERE update_id = $update_id");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Updates has been deleted!");
    } else {
        header("location:./fileupload.php?error=Failed to delete updates!");
    }
}

if (isset($_POST["edit_update"])) {
    $update_id = mysqli_real_escape_string($conn, $_POST["edit_update"]);
    $update_title = mysqli_real_escape_string($conn, $_POST["update_title"]);
    $update_description = mysqli_real_escape_string($conn, $_POST["update_description"]);
    mysqli_query($conn, "UPDATE updates SET update_title = '$update_title', update_description = '$update_description' WHERE update_id = $update_id");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Updates has been updated!");
    } else {
        header("location:./fileupload.php?error=Failed to update updates!");
    }
}

if (isset($_POST["submit_wo"])) {
    $work_title = mysqli_real_escape_string($conn, $_POST["work_title"]);
    mysqli_query($conn, "INSERT INTO work_order (work_name) VALUES('$work_title')");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Work order added");
    } else {
        header("location:./fileupload.php?error=Failed to add order!");
    }
}

if (isset($_POST["delete_wo"])) {
    $work_id = mysqli_real_escape_string($conn, $_POST["wo_id"]);
    mysqli_query($conn, "DELETE FROM work_order WHERE work_id = $work_id");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Work order deleted");
    } else {
        header("location:./fileupload.php?error=Failed to delete order!");
    }
}

if (isset($_POST["submit_expense"])) {
    $expense_name = mysqli_real_escape_string($conn, $_POST["expense_name"]);
    mysqli_query($conn, "INSERT INTO expense_type (expense_name) VALUES('$expense_name')");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Expense type added");
    } else {
        header("location:./fileupload.php?error=Failed to add Expense!");
    }
}

if (isset($_POST["delete_expense"])) {
    $expense_id = mysqli_real_escape_string($conn, $_POST["expense_id"]);
    mysqli_query($conn, "DELETE FROM expense_type WHERE expense_id = $expense_id");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./fileupload.php?success=Expense deleted");
    } else {
        header("location:./fileupload.php?error=Failed to delete expense!");
    }
}




include './includes/header.php';
include './components/navbar.php';
?>

<style>
    .rating {
        font-size: 30px;
        cursor: pointer;
    }

    .star {
        color: #ccc;
        display: inline-block;
        margin-right: 5px;
    }

    .star:hover,
    .star.active {
        color: #ffcc00;
    }
</style>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">File Upload</li>
        </ol>
    </nav>
</div>

<div class="container">
    <?php
    if (isset($_GET["success"])) {
        echo '<div class="alert alert-success" role="alert">' . mysqli_real_escape_string($conn, $_GET["success"]) . '</div>';
    }

    if (isset($_GET["error"])) {
        echo '<div class="alert alert-danger" role="alert">' . mysqli_real_escape_string($conn, $_GET["error"]) . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <form method="POST" class="card">
                <div class="card-header fw-bolder fs-4">Add Work Order</div>
                <div class="card-body">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" required name="work_title" placeholder="workOrderTitle" required>
                        <label for="workOrderTitle">Work Order Title</label>
                    </div>
                    <button type="submit" name="submit_wo" class="btn btn-primary mt-3 col-md-4 col-5">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table table-alternate table-responsive table-bordered table-info text-center">
                <thead>
                    <th>Title</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM work_order");
                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?php echo $row["work_name"] ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="wo_id" value="<?php echo $row["work_id"] ?>">
                                    <button type="submit" name="delete_wo" class="btn btn-danger">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" class="card">
                <div class="card-header fw-bolder fs-4">Add Expense</div>
                <div class="card-body">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" required name="expense_name" placeholder="workOrderTitle" required>
                        <label for="workOrderTitle">Expense Title</label>
                    </div>
                    <button type="submit" name="submit_expense" class="btn btn-primary mt-3 col-md-4 col-5">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table table-alternate table-responsive table-bordered table-info text-center">
                <thead>
                    <th>Title</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM expense_type");
                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?php echo $row["expense_name"] ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="expense_id" value="<?php echo $row["expense_id"] ?>">
                                    <button type="submit" name="delete_expense" class="btn btn-danger">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header fw-bolder fs-4">File Upload</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="update_location" required id="floatingSelect" aria-label="Floating label select example">
                                <option selected value="Main Blog">Main Blog</option>
                                <option value="Sub Main Blog">Sub Main Blog</option>
                                <option value="Secondary Blog">Secondary Blog</option>
                                <option value="Promotion">Promotion</option>
                            </select>
                            <label for="floatingSelect">Select Location</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" required name="update_title" placeholder="fileUploadTitle" required>
                            <label for="fileUploadTitle">Title</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" required placeholder="Context" name="update_description" style="height: 100px"></textarea>
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
                            <input type="file" onchange="previewFile()" required class="form-control" id="fileUploadImage" required>
                            <input type="hidden" name="update_image" id="update_image">
                            <label for="fileUploadImage">Image Upload</label>

                            <script>
                                function previewFile() {
                                    const fileInput = document.getElementById('fileUploadImage');
                                    const file = fileInput.files[0];
                                    const reader = new FileReader();

                                    reader.onloadend = function() {
                                        document.getElementById("update_image").value = reader.result;;
                                    }

                                    reader.readAsDataURL(file);
                                }
                            </script>
                        </div>
                        <button type="submit" name="submit_update" class="btn btn-primary mt-3 col-md-4 col-5">Submit</button>
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
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM updates");

                    while ($row = $result->fetch_assoc()) :
                    ?>
                        <tr>
                            <td><?php echo $row["update_location"] ?></td>
                            <td><?php echo $row["update_title"] ?></td>
                            <td>
                                <div class="d-md-flex justify-content-around d-sm-none">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-3 mb-md-0">
                                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row["update_id"] ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <div class="modal fade" id="modal<?php echo $row["update_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Blog ( <?php echo $row["update_title"] ?> )</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <div class="mb-3 form-floating">
                                                                    <input type="text" class="form-control" required name="update_title" value="<?php echo $row["update_title"] ?>" placeholder="fileUploadTitle" required>
                                                                    <label for="fileUploadTitle">Title</label>
                                                                </div>
                                                                <div class="mb-3 form-floating">
                                                                    <textarea class="form-control" required placeholder="Context" name="update_description" style="height: 100px"><?php echo $row["update_description"] ?></textarea>
                                                                    <label for="floatingTextarea2">Context</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="edit_update" value="<?php echo $row["update_id"] ?>" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <form method="POST">
                                                <input type="hidden" name="update_id" value="<?php echo $row["update_id"] ?>">
                                                <button type="submit" name="delete_update" class="btn btn-danger">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile ?>

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
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header fw-bolder fs-4">Testimony</div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-floating mb-3" style="display: none;">
                                <select class="form-select" name="update_location" required id="floatingSelect" aria-label="Floating label select example">
                                    <option selected value="Testimony">Testimony</option>
                                </select>
                                <label for="floatingSelect">File Location</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" required placeholder="Location" required>
                                <label for="testimonyTitle">Title</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" required placeholder="Location" required>
                                <label for="testimonyLocation">Location</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" required placeholder="Age" required>
                                <label for="testimonyAge">Age</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <select class="form-select" required id="floatingSelect" aria-label="Floating label select example">
                                    <option selected value="Testimony">Moving Services</option>
                                </select>
                                <label for="floatingSelect">Select Work Order</label>
                            </div>
                            <div class="rating">
                                <span class="star" data-rating="1">&#9733;</span>
                                <span class="star" data-rating="2">&#9733;</span>
                                <span class="star" data-rating="3">&#9733;</span>
                                <span class="star" data-rating="4">&#9733;</span>
                                <span class="star" data-rating="5">&#9733;</span>
                            </div>
                            <div class="mb-3 form-floating">
                                <textarea class="form-control" required placeholder="Context" name="update_description" style="height: 100px"></textarea>
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
                                <input type="file" onchange="previewFile()" required class="form-control" id="fileUploadImage" required>
                                <input type="hidden" name="update_image" id="update_image">
                                <label for="fileUploadImage">Image Upload</label>

                                <script>
                                    function previewFile() {
                                        const fileInput = document.getElementById('fileUploadImage');
                                        const file = fileInput.files[0];
                                        const reader = new FileReader();

                                        reader.onloadend = function() {
                                            document.getElementById("update_image").value = reader.result;;
                                        }

                                        reader.readAsDataURL(file);
                                    }
                                </script>
                            </div>
                            <button type="submit" name="submit_update" class="btn btn-primary mt-3 col-md-4 col-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-hover table-info text-center">
                    <thead>
                        <th>Title</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Testimony 1</td>
                            <td><button class="btn btn-danger">
                                    <li class="fas fa-trash"></li>
                            </td></button>
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

</div>

<?php
include './includes/footer.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');
        const selectedRatingElement = document.getElementById('selectedRating');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = parseFloat(star.getAttribute('data-rating'));

                // Check if the clicked star is already selected as a half-star
                if (rating === selectedRating - 0.5) {
                    selectedRating = Math.floor(selectedRating);
                } else {
                    selectedRating = rating;
                }

                updateRating(selectedRating);
            });

            star.addEventListener('mouseover', () => {
                const rating = parseFloat(star.getAttribute('data-rating'));
                highlightStars(rating);
            });

            star.addEventListener('mouseout', () => {
                resetStars();
                highlightStars(selectedRating);
            });
        });

        function highlightStars(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function resetStars() {
            stars.forEach(star => {
                star.classList.remove('active');
            });
        }

    });
</script>
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