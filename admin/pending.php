<?php
session_start();
include '../connection.php';

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
                $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1");
                while ($row = $result->fetch_assoc()) :
                    $inq_id = $row["inquiry_id"];
                    $info = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $inq_id; ?></td>
                        <td><?php echo date('M d, Y', $info["accepted_start_date"]); ?></td>
                        <td><?php echo $info["accepted_client_name"]; ?></td>
                        <td><?php echo $row["client_number"]; ?></td>
                        <td><?php echo $info["accepted_location"]; ?></td>
                        <td><?php echo $row["client_wo"]; ?></td>
                        <td>
                            <div class="badge text-bg-danger">
                                Pending
                            </div>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="inquiry_id" value="<?php echo $inq_id; ?>">
                                <div class="wrapper d-md-flex justify-content-around d-sm-none">
                                    <button type="submit" name="complete" class="btn btn-primary col-12 col-md-5 mb-3 mb-md-0">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button type="submit" name="decline" class="btn btn-danger col-12 col-md-5">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>

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

<?php
include './includes/footer.php';
?>