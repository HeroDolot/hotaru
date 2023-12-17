<title>Admin Dashboard | History</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])){
    header("location:../login.php");
}

include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">History</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-success text-center align-middle">
            <thead>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Mail Address</th>
                <th>Region</th>
                <th>Work Order</th>
                <th>Status</th>
            </thead>
            <tbody>

                <?php 
                $result = mysqli_query($conn,"SELECT * FROM accepted");
                while ($row = $result->fetch_assoc()):
                    $inq_id = $row["accepted_inquiry_id"];
                    $inqInfo = mysqli_query($conn,"SELECT * FROM inquiry WHERE inquiry_id = $inq_id")->fetch_assoc();
                    $inqWo = $inqInfo["client_wo"];

                ?>
                <tr>
                    <td><?php echo $row["accepted_client_name"]?></td>
                    <td><?php echo $inqInfo["client_name"]?></td>
                    <td><?php echo $inqInfo["client_email"]?></td>
                    <td><?php echo $inqInfo["client_region"]?></td>
                    <td><?php echo mysqli_query($conn,"SELECT * FROM work_order WHERE work_id = $inqWo")->fetch_assoc()["work_name"]?></td>
                    <td>
                        <?php 
                        if ($row["accepted_completed_date"] != 0){
                        ?>
                        <div class="badge text-bg-success">
                            Completed
                        </div>
                        <?php } else {?>
                            <div class="badge text-bg-danger">
                            Pending
                        </div>
                        <?php }?>
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


<?php
include './includes/footer.php';
?>