<title>Admin Dashboard | Expenses</title>

<?php
session_start();
include('../connection.php');



include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Expenses</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-12 mt-5">
            <h4 class="fw-bolder">Recent Expenses</h4>
            <table class="table table-responsive table-bordered table-danger table-alternate">
                <thead>
                    <th>#</th>
                    <th>TITLE</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                </thead>
                <tbody>
                    <?php 
                    
                    $result = mysqli_query($conn,"SELECT * FROM expense_history");
                    while ($row = $result->fetch_assoc()):
                        $exp_id = $row["exp_history_expense_id"];

                    ?>
                    <tr>
                        <td><?php echo $row["exp_history_id"]?></td>
                        <td><?php echo mysqli_query($conn,"SELECT * FROM expense_type WHERE expense_id = $exp_id")->fetch_assoc()["expense_name"];?></td>
                        <td><?php echo number_format($row["exp_history_price"])?>¥</td>
                        <td><?php echo number_format($row["expense_quantity"])?></td>
                        <td><?php echo number_format($row["exp_history_price"] * $row["expense_quantity"])?>¥</td>
                    </tr>
                    <?php endwhile?>


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

            $index = array_search(date("M-Y", $acceptedInfo["accepted_start_date"]),$monthYear);
            if ($index !== false){
                if (isset($salesData[$index])){
                    $salesData[$index] = $salesData[$index] + $acceptedInfo["accepted_contract"];
                } else {
                    $salesData[$index] = $acceptedInfo["accepted_contract"];
                }
            }
        }
        ?>
    ];


    const salesData = [ 0,
        <?php 
        foreach ($salesData as $value){
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