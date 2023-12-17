<title>Admin Dashboard | Pending</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])){
    header("location:../login.php");
}
if (isset($_POST["complete"])) {
    $inq_id = mysqli_real_escape_string($conn, $_POST["inquiry_id"]);
    mysqli_query($conn, "UPDATE inquiry SET inquiry_status = 2 WHERE inquiry_id = $inq_id");
    $currentDate = time();
    if (mysqli_affected_rows($conn) == 1) {
        mysqli_query($conn, "UPDATE accepted SET accepted_completed_date = $currentDate WHERE accepted_inquiry_id = $inq_id");
        if (mysqli_affected_rows($conn) == 1) {
            header("location:./pending.php?success=Work order complete");
        } else {
            header("location:./pending.php?error=Work order failed to complete!");
        }
    } else {
        header("location:./pending.php?error=Pending work order failed to complete!");
    }
}

if (isset($_POST["decline"])) {
    $inq_id = mysqli_real_escape_string($conn, $_POST["inquiry_id"]);
    mysqli_query($conn, "UPDATE inquiry SET inquiry_status = -1 WHERE inquiry_id = $inq_id");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./pending.php?success=Pending work order decline!");
    } else {
        header("location:./pending.php?error=Pending work order failed to decline!");
    }
}

if (isset($_POST["submit_expense"])) {
    var_dump($_POST);
    $inquiry_id = mysqli_real_escape_string($conn, $_POST["inquiry_id"]);
    $expense_type_id = mysqli_real_escape_string($conn, $_POST["expense_type"]);
    $expense_price = mysqli_real_escape_string($conn, $_POST["expense_price"]);
    $expense_quantity = mysqli_real_escape_string($conn, $_POST["expense_quantity"]);

    mysqli_query($conn, "INSERT INTO expense_history (exp_history_inquiry_id,exp_history_expense_id,exp_history_price,expense_quantity) VALUES($inquiry_id,$expense_type_id,$expense_price,$expense_quantity)");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./pending.php?success=Expense added to client");
    } else {
        header("location:./pending.php?error=Failed to add expense to client");
    }
}


include './includes/header.php';
include './components/navbar.php';

?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pending</li>
        </ol>
    </nav>
</div>


<div class="container mt-5">

    <?php
    if (isset($_GET["success"])) {
        echo '<div class="alert alert-success" role="alert">' . mysqli_real_escape_string($conn, $_GET["success"]) . '</div>';
    } else if (isset($_GET["error"])) {
        echo '<div class="alert alert-danger" role="alert">' . mysqli_real_escape_string($conn, $_GET["error"]) . '</div>';
    }
    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-danger align-middle">
            <thead>
                <th>#</th>
                <th>Date</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Location</th>
                <th>W.O</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
              $records_per_page = 5;

              // Get the current page or set it to 1 if not set
              $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              
              // Calculate the starting record for the current page
              $start_from = ($current_page - 1) * $records_per_page;
              
              // Fetch data with pagination
              $result_inquiries = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1 LIMIT $start_from, $records_per_page");
              
              
                while ($row_inquiry = $result_inquiries->fetch_assoc()) :
                    $inq_id = $row_inquiry["inquiry_id"];
                    $info = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
                    $wo_id = $row_inquiry["client_wo"];
                ?>

                    <tr>
                        <td><?php echo $inq_id; ?></td>
                        <td><?php echo date('M d, Y', $info["accepted_start_date"]); ?></td>
                        <td><?php echo $info["accepted_client_name"]; ?></td>
                        <td><?php echo $row_inquiry["client_number"]; ?></td>
                        <td><?php echo $info["accepted_location"]; ?></td>
                        <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"]; ?></td>
                        <td>
                            <div class="badge text-bg-danger">
                                Pending
                            </div>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="inquiry_id" value="<?php echo $inq_id; ?>">
                                <div class="btn-group d-md-flex justify-content-around d-sm-none" role="group" aria-label="Button group">
                                    <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $inq_id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="submit" name="complete" class="btn btn-primary">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="submit" name="decline" class="btn btn-danger">
                                        <i class="fas fa-xmark"></i>
                                    </button>
                                </div>
                            </form>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $inq_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Expense | <?php echo $info["accepted_client_name"] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST">
                                            <input type="hidden" name="inquiry_id" value="<?php echo $inq_id ?>">
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="expense_type" id="floatingSelect" aria-label="Floating label select example">
                                                        <option selected disabled value="">Choose Expense</option>
                                                        <?php
                                                        $result_expenses = mysqli_query($conn, "SELECT * FROM expense_type");
                                                        while ($row_expense = $result_expenses->fetch_assoc()) {
                                                            echo '<option value="' . $row_expense["expense_id"] . '">' . $row_expense["expense_name"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Expense</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating" id="floatingPrice">
                                                            <input type="text" class="form-control" name="expense_price" id="" placeholder="Price">
                                                            <label for="floatingPrice">Price</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating" id="floatingQuantity">
                                                            <input type="text" class="form-control" name="expense_quantity" id="" placeholder="Quantity">
                                                            <label for="floatingQuantity">Quantity</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="submit_expense" class="btn btn-primary">Add Expense</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                <?php endwhile; ?>


            </tbody>
        </table>
      <!-- Pagination links -->
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php
        // Calculate total number of pages
        $total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1")) / $records_per_page);

        // Previous page link
        if ($current_page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
        }

        // Page links
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        // Next page link
        if ($current_page < $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
        }
        ?>
    </ul>
</nav>
    </div>
</div>

<?php
include './includes/footer.php';
?>