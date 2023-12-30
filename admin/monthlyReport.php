<title>請求書レポート - 不用品回収代行サービス</title>
<?php
// Start session and include connection
session_start();
include '../connection.php';

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

.table th, .table td {
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
            <h5>Date: December 2024</h5>

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
                                    <tr>
                                        <th>Work order 1</th>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <th>Work order 2</th>
                                        <td>8</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end">Total:</th>
                                        <td>12</td>
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
                            <tr>
                                <td>1(justnumber)</td>
                                <td>December 1, 2024</td>
                                <td>House Relocation</td>
                                <td>¥20,000</td>
                                <td>¥1,000</td>
                                <td>¥3,000</td>
                                <td>¥16,000</td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <td>¥20,000</td>
                                <td>¥1,000</td>
                                <td>¥3,000</td>
                                <td>¥16,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>