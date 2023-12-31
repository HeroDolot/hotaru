<title>管理者ダッシュボード | 収入</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])) {
    header("location:../login.php");
}


include './includes/header.php';
include './components/navbar.php';

$records_per_page = 4; // You can adjust this value as needed

// Determine the current page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1; // Default to the first page
}

// Calculate the OFFSET for the SQL query
$offset = ($page - 1) * $records_per_page;
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">収入</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <canvas id="salesChart"></canvas>
        </div>
        <div class="col-md-4 col-12 mt-5">
            <h4 class="fw-bolder">最近の作業オーダー</h4>
            <table class="table table-responsive table-bordered table-info table-alternate">
                <thead>
                    <th>名前</th>
                    <th>日付</th>
                    <th>WO</th>
                    <th>収入</th>
                    <th>アクション</th>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status >= 2 LIMIT $records_per_page OFFSET $offset");
                    while ($row = $result->fetch_assoc()) :
                        $inquiry_id = $row["inquiry_id"];
                        $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
                        $wo_id = $row["client_wo"];
                    ?>
                        <tr>
                            <td><?php echo $acceptedInfo["accepted_client_name"]; ?></td>
                            <td><?php echo date("M d, Y", $acceptedInfo["accepted_start_date"]) ?></td>
                            <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"]; ?></td>
                            <td>¥<?php echo number_format($acceptedInfo["accepted_contract"]) ?></td>
                            <th>
                                <a class="btn btn-info text-white" href="./completedReport.php?id=<?php echo $row["inquiry_id"] ?>">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </th>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    // Count the total number of records
                    $total_records = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status >= 2"));

                    // Calculate the total number of pages
                    $total_pages = ceil($total_records / $records_per_page);

                    // Previous page link
                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                    }

                    // Page links
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }

                    // Next page link
                    if ($page < $total_pages) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Sales Data
    const months = ["Jan-1970",
        <?php
        $result = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_status >= 2");
        $monthYear = array();
        $salesData = array();
        while ($row = $result->fetch_assoc()) {
            $inquiry_id = $row["inquiry_id"];
            $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
            if (!in_array(date("M-Y", $acceptedInfo["accepted_start_date"]), $monthYear)) {
                $monthYear[] = date("M-Y", $acceptedInfo["accepted_start_date"]);
                echo '"' . date("M-Y", $acceptedInfo["accepted_start_date"]) . '",';
            }

            $index = array_search(date("M-Y", $acceptedInfo["accepted_start_date"]), $monthYear);
            if ($index !== false) {
                if (isset($salesData[$index])) {
                    $salesData[$index] = $salesData[$index] + $acceptedInfo["accepted_contract"];
                } else {
                    $salesData[$index] = $acceptedInfo["accepted_contract"];
                }
            }
        }
        ?>
    ];


    const salesData = [0,
        <?php
        foreach ($salesData as $value) {
            echo $value . ',';
        }
        ?>
    ];

    // Line Chart Data
    const data = {
        labels: months,
        datasets: [{
            label: '販売',
            data: salesData,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 5
        }]
    };

    // Line Chart Configuration
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Create and render the Line Chart
    const myChart = new Chart(ctx, config);
</script>

<?php
include './includes/footer.php';
?>