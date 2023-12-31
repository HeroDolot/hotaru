<title>管理者ダッシュボード | 経費</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])){
    header("location:../login.php");
}


include './includes/header.php';
include './components/navbar.php';

// Assuming you have already established a database connection ($conn)

// Set the number of items per page
$itemsPerPage = 10; // You can adjust this as needed

// Get the current page number from the query string, default to 1 if not set
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $itemsPerPage;

// Fetch data for the current page
$result = mysqli_query($conn, "SELECT * FROM expenses LIMIT $offset, $itemsPerPage");

?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">経費</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-12 mt-5">
            <h4 class="fw-bolder">最近の経費</h4>
            <table class="table table-responsive table-bordered table-danger table-alternate">
                <thead>
                    <th>#</th>
                    <th>タイトル</th>
                    <th>価格</th>
                    <th>数量</th>
                    <th>合計</th>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["expense_id"] ?></td>
                            <td><?php echo $row["expense_title"] ?></td>
                            <td><?php echo number_format($row["expense_price"]) ?>¥</td>
                            <td><?php echo number_format($row["expense_quantity"]) ?></td>
                            <td><?php echo number_format($row["expense_price"] * $row["expense_quantity"]) ?>¥</td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    // Calculate the total number of pages
                    $totalPages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM expenses")) / $itemsPerPage);

                    // Generate pagination links
                    for ($i = 1; $i <= $totalPages; $i++) :
                    ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor ?>
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
            label: 'Expenses',
            data: salesData,
            borderColor: 'rgb(238, 75, 43)',
            backgroundColor: 'rgb(238, 75, 43)',
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