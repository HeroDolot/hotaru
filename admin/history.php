<title>管理者ダッシュボード | 履歴</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])) {
    header("location:../login.php");
}

include './includes/header.php';
include './components/navbar.php';

// Define the number of records per page
$recordsPerPage = 10;

// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1;
}

// Calculate the offset for the query
$offset = ($currentPage - 1) * $recordsPerPage;

// Fetch records with pagination
$query = "SELECT * FROM accepted LIMIT $offset, $recordsPerPage";
$result = mysqli_query($conn, $query);

?>

<section style="min-height: 49vh;">
    <div class="container-fluid py-5 p-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fw-bold fs-3">
                <li class="breadcrumb-item"><a href="./index.php">ホーム</a></li>
                <li class="breadcrumb-item active" aria-current="page">履歴</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-success text-center align-middle">
                <thead>
                    <th>名前</th>
                    <th>連絡先番号</th>
                    <th>メールアドレス</th>
                    <th>地域</th>
                    <th>作業依頼</th>
                    <th>ステータス</th>
                </thead>
                <tbody>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) :
                        $inq_id = $row["accepted_inquiry_id"];
                        $inqInfo = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_id = $inq_id")->fetch_assoc();
                        $inqWo = $inqInfo["client_wo"];
                    ?>
                        <tr>
                            <td><?php echo $row["accepted_client_name"] ?></td>
                            <td><?php echo $inqInfo["client_name"] ?></td>
                            <td><?php echo $inqInfo["client_email"] ?></td>
                            <td><?php echo $inqInfo["client_region"] ?></td>
                            <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $inqWo")->fetch_assoc()["work_name"] ?></td>
                            <td>
                                <?php
                                if ($row["accepted_completed_date"] != 0) {
                                ?>
                                    <div class="badge text-bg-success">
                                        完了
                                    </div>
                                <?php } else { ?>
                                    <div class="badge text-bg-danger">
                                        未完了
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>

            <!-- Pagination links -->
            <?php
            $totalRecords = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM accepted"));
            $totalPages = ceil($totalRecords / $recordsPerPage);

            echo '<nav aria-label="Page navigation example">';
            echo '<ul class="pagination">';

            if ($currentPage > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }

            if ($currentPage < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
            }

            echo '</ul>';
            echo '</nav>';
            ?>

        </div>
    </div>
</section>
<?php
include './includes/footer.php';
?>