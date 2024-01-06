<title>請求書レポート - 不用品回収代行サービス</title>
<?php
// Start session and include connection
session_start();
include '../connection.php';

if (!isset($_GET["query"])) {
    header("location:./reports.php");
}

$monthYear = mysqli_real_escape_string($conn, $_GET["query"]);

// Include header
include './includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            page-break-inside: avoid;
        }

        .table th,
        .table td {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Header Section -->
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <p class="fw-bolder" style="font-size: 55px;"><span class="text-primary">不用品回収代行サービス</p>
                </div>
                <p class="text-secondary">東京都台東区根岸3-16-14 チャームハイツ201号室</p>
            </div>
            <div class="col-md-6 text-md-end mt-0 mt-md-5">
                <p class="text-info fw-bolder" style="font-size: 25px;">Monthly Report</p>
                <p class="text-secondary"><?php echo date('Y年m月d日') ?></p>
            </div>
        </div>

        <hr style="border: 1px solid black;">
        <div class="container">
            <h5>Date: <?php echo $monthYear ?></h5>

            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th class="text-center" colspan="2">Work Order Volume</th>
                                </thead>
                                <tbody>
                                    <!-- (get from select option work orders) -->

                                    <?php
                                    $total = 0;
                                    $result = mysqli_query($conn, "SELECT completed_date, work_order.work_name, COUNT(*) as wo_count FROM monthly_report INNER JOIN work_order on monthly_report.client_wo = work_order.work_id WHERE completed_date = '$monthYear' GROUP BY completed_date;");
                                    while ($row = $result->fetch_assoc()) :
                                        $total = $total + $row["wo_count"];
                                    ?>
                                        <tr>
                                            <th><?php echo $row["work_name"] ?></th>
                                            <td><?php echo $row["wo_count"] ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <tr>
                                        <th class="text-end">Total:</th>
                                        <td><?php echo $total; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th class="text-center" colspan="3">Assets</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $assetTotal = 0;
                                    $result = mysqli_query($conn, "SELECT * FROM assets WHERE DATE_FORMAT(FROM_UNIXTIME(asset_date_acquired), '%M %Y') = '$monthYear'");

                                    while ($row = $result->fetch_assoc()) :
                                        $subtotal = $row["asset_price"] * $row["asset_quantity"];
                                        $assetTotal = $assetTotal + $subtotal;
                                    ?>
                                        <tr>
                                            <th><?php echo $row["asset_name"] ?></th>
                                            <td><?php if ($row["asset_quantity"] == 1) {
                                                    echo $row["asset_quantity"] . " pc";
                                                } else {
                                                    echo $row["asset_quantity"] . " pcs";
                                                } ?></td>
                                            <td>¥<?php echo number_format($subtotal); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <tr>
                                        <th class="text-end" colspan="2">Total:</th>
                                        <td>¥<?php echo number_format($assetTotal); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

            <div class="container mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Date</th>
                            <th>Work Order</th>
                            <th>Contract</th>
                            <th>Commission</th>
                            <th>Expenses</th>
                            <th>Profit</th>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $totalContract = 0;
                            $totalCommission = 0;
                            $totalExpenses = 0;
                            $totalProfit = 0;
                            // echo "SELECT * FROM accepted WHERE DATE_FORMAT(FROM_UNIXTIME(accepted_completed_date), '%M %Y') = '$monthYear'";
                            $result = mysqli_query($conn, "SELECT * FROM accepted WHERE DATE_FORMAT(FROM_UNIXTIME(accepted_completed_date), '%M %Y') = '$monthYear'");
                            while ($row = $result->fetch_assoc()) :
                                $count++;
                                $inq_id = $row["accepted_inquiry_id"];
                                $contract = $row["accepted_contract"];
                                $work_name = mysqli_query($conn, "SELECT work_order.work_name FROM accepted JOIN inquiry ON accepted.accepted_inquiry_id = inquiry.inquiry_id JOIN work_order ON inquiry.client_wo = work_order.work_id WHERE accepted_inquiry_id = $inq_id;")->fetch_assoc()["work_name"];
                                $work_commission = mysqli_query($conn, "SELECT work_order.work_commission FROM accepted JOIN inquiry ON accepted.accepted_inquiry_id = inquiry.inquiry_id JOIN work_order ON inquiry.client_wo = work_order.work_id WHERE accepted_inquiry_id = $inq_id;")->fetch_assoc()["work_commission"];
                                $expense = mysqli_query($conn, "SELECT SUM(expense_price * expense_quantity) as total FROM expenses WHERE expense_inquiry_id = $inq_id")->fetch_assoc()["total"] - $work_commission;
                                $profit = $row["accepted_contract"] - $expense - $work_commission;
                                $totalContract = $totalContract + $contract;
                                $totalCommission = $totalCommission + $work_commission;
                                $totalExpenses = $totalExpenses + $expense;
                                $totalProfit = $totalProfit + $profit;
                            ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo date("F j, Y", $row["accepted_completed_date"]) ?></td>
                                    <td><?php echo $work_name ?></td>
                                    <td>¥<?php echo number_format($contract) ?></td>
                                    <td>¥<?php echo number_format($work_commission); ?></td>
                                    <td>¥<?php echo number_format($expense); ?></td>
                                    <td>¥<?php echo number_format($profit) ?></td>
                                </tr>
                            <?php endwhile;

                            if ($assetTotal != 0) :
                                $totalExpenses = $totalExpenses + $assetTotal;
                                $totalProfit = $totalProfit - $assetTotal;
                            ?>
                                <tr>
                                    <td><?php echo $count + 1; ?></td>
                                    <td colspan="2" class="text-center">Total Assets Acquired</td>
                                    <td>¥0</td>
                                    <td>¥0</td>
                                    <td>¥<?php echo number_format($assetTotal);?></td>
                                    <td>¥0</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <td>¥<?php echo number_format($totalContract) ?></td>
                                <td>¥<?php echo number_format($totalCommission) ?></td>
                                <td>¥<?php echo number_format($totalExpenses) ?></td>
                                <td>¥<?php echo number_format($totalProfit) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>