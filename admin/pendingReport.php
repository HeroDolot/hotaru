<title>保留中のレポート - 不用品回収代行サービス</title>
<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])) {
    header("location:../login.php");
}
if (isset($_GET["id"])) :
    $inquiry_id = mysqli_real_escape_string($conn, $_GET["id"]);
    $info = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_id = $inquiry_id")->fetch_assoc();

    $accepted = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();


?>

    <?php
    include './includes/header.php';
    ?>
    <style>
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                margin: 1cm auto;
                font-family: Arial, sans-serif;
            }

            .container {
                max-width: 100%;
            }

            table {
                width: 120%;
                /* Adjusted width of the table */
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .table-customer-information {
                width: 100% !important;
                /* Adjusted width of the table */
            }

            th,
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            hr {
                border: 0.5px solid black;
                margin: 20px 0;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .text-left {
                text-align: left;
            }
        }
    </style>


    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <p class="fw-bolder" style="font-size: 55px;"><span class="text-primary">不用品回収代行サービス</p>
                </div>
                <p class="text-secondary">東京都台東区根岸3-16-14 チャームハイツ201号室</p>
                <div class="form-check form-switch">
                    <input class="form-check-input" onchange="switchMode(this)" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">クライアントコピー</label>
                </div>
            </div>
            <div class="col-md-6 text-md-end mt-0 mt-md-5">
                <p class="text-info fw-bolder" style="font-size: 25px;">請求書</p>
                <p class="text-secondary"><?php echo date('Y年m月d日') ?></p>
            </div>
        </div>
        <hr style="border: 1px solid black;">
        <div class="row py-4 d-flex justify-content-between">
            <div class="col-md-4">
                <table class="table text-center table-responsive align-middle">
                    <thead class="table-info">
                        <th>#</th>
                        <th>開始日</th>
                        <th>終了日</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $accepted["accepted_id"] ?>
                            </td>
                            <td><?php echo date('M d, Y', $accepted["accepted_start_date"]) ?></td>
                            <td><?php echo date('M d, Y', $accepted["accepted_completed_date"]) ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-md-4">
                <table class="table">
                    <thead class="table-primary">
                        <th style="font-size: 17px;" colspan="3">ジョブの状態</th>
                    </thead>
                    <tbody>
                        <tr class="fw-bolder">
                            <th>ステータス:</th>
                            <td class="text-danger">保留中</td>
                            <!-- <td class="text-warning">4 Days</td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <table class="table table-customer-information">
                    <thead class="table-info">
                        <th style="font-size: 17px;" colspan="2">顧客情報</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="fw-bolder">名前:</th>
                            <td><?php echo $accepted["accepted_client_name"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">連絡先番号:</th>
                            <td><?php echo $info["client_number"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">電話/メール</th>
                            <td><?php echo $info["preferred_contact"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">住所:</th>
                            <td><?php echo $accepted["accepted_location"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">契約金額:</th>
                            <td><?php echo number_format($accepted["accepted_contract"]) ?> 円</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">作業オーダー:</th>
                            <td><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = {$info['client_wo']}")->fetch_assoc()['work_name']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-7 mt-4 mt-md-0"> <!-- Added margin top for smaller screens -->
                <label for="context" class="fw-bolder">作業オーダーコンテキスト</label>
                <textarea class="form-control" style="border: 2px solid black; width: 100%;" name="" id="context" cols="40" rows="7" readonly><?php echo $info["client_comment"] ?></textarea>
            </div>

            <table id="expense_table" class="table table-bordered table-responsive text-center">
                <thead class="table-danger">
                    <tr>
                        <th colspan="5" style="letter-spacing:5px;">経費</th>
                    </tr>
                </thead>
                <thead style="text-transform: uppercase;">
                    <tr>
                        <th>#</th>
                        <th>タイトル</th>
                        <th>価格</th>
                        <th>Quantity</th>
                        <th>合計</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $count = 0;
                    $result = mysqli_query($conn, "SELECT * FROM expenses WHERE expense_inquiry_id = $inquiry_id");
                    while ($row = $result->fetch_assoc()) :
                        $count++;
                        $subtotal = $row["expense_price"];
                        $total = $total + $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $row["expense_title"] ?></td>
                            <td><?php echo number_format($row["expense_price"]) ?>¥</td>
                            <td><?php echo $row["expense_quantity"] ?></td>
                            <td><?php echo number_format($subtotal) ?>¥</td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"></th>
                        <th>合計: <?php echo number_format($total); ?>¥</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th>総利益: <?php echo number_format($accepted["accepted_contract"] - $total); ?>¥</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    <?php endif; ?>


    <script>
        function switchMode(element) {
            table = document.getElementById("expense_table");
            if (element.checked) {
                table.style.opacity = '0';
            } else {
                table.style.opacity = '1';
            }
        }
    </script>