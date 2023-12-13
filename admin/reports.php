<title>Admin Dashboard | Reports</title>
<?php
session_start();
include '../connection.php';

include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
        </ol>
    </nav>
</div>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Reports Overview</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabsContent">
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <!-- <p>Reports Overview Content Goes Here</p> -->
            <div class="container mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-info align-middle">
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
                            $results_per_page = 10;

                            $total_results = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1 OR inquiry_status = 2"));
                            $total_pages = ceil($total_results / $results_per_page);

                            if (!isset($_GET['overview'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['overview'];
                            }

                            $starting_index = ($page - 1) * $results_per_page;

                            $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1 OR inquiry_status = 2 LIMIT $starting_index, $results_per_page");

                            while ($row = $result->fetch_assoc()) :
                                $inq_id = $row["inquiry_id"];
                                $info = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
                                $wo_id = $row["client_wo"];
                            ?>

                                <tr>
                                    <td><?php echo $inq_id ?></td>
                                    <td><?php echo date('M d, Y', $info["accepted_start_date"]) ?></td>
                                    <td><?php echo $info["accepted_client_name"] ?></td>
                                    <td><?php echo $row["client_number"] ?></td>
                                    <td><?php echo $info["accepted_location"] ?></td>
                                    <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"] ?></td>
                                    <td>
                                        <?php
                                        if ($row["inquiry_status"] == 2) {
                                            echo '<div class="badge text-bg-success">Completed</div>';
                                        }

                                        if ($row["inquiry_status"] == 1) {
                                            echo '<div class="badge text-bg-danger">Pending</div>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="wrapper d-md-flex justify-content-around d-sm-none">
                                            <?php if ($row["inquiry_status"] == 2) : ?>
                                                <a href="./completedReport.php?id=<?php echo $row["inquiry_id"] ?>" target="_blank" class="btn btn-info col-12 col-md-12 mb-3 mb-md-0">
                                                    <i class="fa-solid fa-eye text-white"></i>
                                                </a>

                                            <?php elseif ($row["inquiry_status"] == 1) : ?>
                                                <a href="./pendingReport.php?id=<?php echo $row["inquiry_id"] ?>" target="_blank" class="btn btn-info col-12 col-md-12 mb-3 mb-md-0">
                                                    <i class="fa-solid fa-eye text-white"></i>
                                                </a>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?overview=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
            <!-- Content for Pending tab -->
            <!-- <p>Pending Content Goes Here</p> -->

            <div class="container mt-5">
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
                            $results_per_page = 10;

                            $total_results = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1"));
                            $total_pages = ceil($total_results / $results_per_page);

                            if (!isset($_GET['pending'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['pending'];
                            }

                            $starting_index = ($page - 1) * $results_per_page;

                            $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 1 LIMIT $starting_index, $results_per_page");

                            while ($row = $result->fetch_assoc()) :
                                $inq_id = $row["inquiry_id"];
                                $info = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
                                $wo_id = $row["client_wo"];
                            ?>

                                <tr>
                                    <td><?php echo $inq_id ?></td>
                                    <td><?php echo date('M d, Y', $info["accepted_start_date"]) ?></td>
                                    <td><?php echo $info["accepted_client_name"] ?></td>
                                    <td><?php echo $row["client_number"] ?></td>
                                    <td><?php echo $info["accepted_location"] ?></td>
                                    <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"]; ?></td>
                                    <td>
                                        <?php
                                        if ($row["inquiry_status"] == 2) {
                                            echo '<div class="badge text-bg-success">Completed</div>';
                                        }

                                        if ($row["inquiry_status"] == 1) {
                                            echo '<div class="badge text-bg-danger">Pending</div>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="wrapper d-md-flex justify-content-around d-sm-none">
                                            <a href="./pendingReport.php?id=<?php echo $row["inquiry_id"] ?>" target="_blank" class="btn btn-info col-12 col-md-12 mb-3 mb-md-0">
                                                <i class="fa-solid fa-eye text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?pending=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
            <!-- Content for Completed tab -->
            <!-- <p>Completed Content Goes Here</p> -->
            <div class="container mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-success align-middle">
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
                            $recordsPerPage = 10;
                            $currentPage = isset($_GET['completed']) ? $_GET['completed'] : 1;
                            $offset = ($currentPage - 1) * $recordsPerPage;
                            $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 2 LIMIT $offset, $recordsPerPage");

                            while ($row = $result->fetch_assoc()) :
                                $inq_id = $row["inquiry_id"];
                                $info = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inq_id")->fetch_assoc();
                                $wo_id = $row["client_wo"];
                            ?>
                                <tr>
                                    <td><?php echo $inq_id ?></td>
                                    <td><?php echo date('M d, Y', $info["accepted_start_date"]) ?></td>
                                    <td><?php echo $info["accepted_client_name"] ?></td>
                                    <td><?php echo $row["client_number"] ?></td>
                                    <td><?php echo $info["accepted_location"] ?></td>
                                    <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"]; ?></td>
                                    <td>
                                        <?php
                                        if ($row["inquiry_status"] == 2) {
                                            echo '<div class="badge text-bg-success">Completed</div>';
                                        }

                                        if ($row["inquiry_status"] == 1) {
                                            echo '<div class="badge text-bg-danger">Pending</div>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="wrapper d-md-flex justify-content-around d-sm-none">
                                            <a href="#" target="_blank" class="btn btn-info col-12 col-md-12 mb-3 mb-md-0">
                                                <i class="fa-solid fa-eye text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            <?php endwhile; ?>

                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                            $totalPages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status = 2")) / $recordsPerPage);

                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?completed=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include './includes/footer.php';
?>