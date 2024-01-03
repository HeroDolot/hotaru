<title>請求書レポート - 不用品回収代行サービス</title>
<?php
// Start session and include connection
session_start();
include '../connection.php';

if (!isset($_SESSION["user_email"])) {
    header("location:../login.php");
}
// Check if inquiry ID is set
if (isset($_GET["id"])) :
    $inquiry_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Retrieve inquiry information
    $inquiryInfo = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_id = $inquiry_id AND inquiry_status >= 1");

    // If inquiry exists, fetch information
    if ($inquiryInfo->num_rows == 1) {
        $inquiryInfo = $inquiryInfo->fetch_assoc();
        $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
    }

    // Include header
    include './includes/header.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            /* Add your custom styles here */
            @media print {

                /* Styles for print view */
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
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }

                .table-customer-information {
                    width: 100%;
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
                    <div class="form-check form-switch">
                        <input class="form-check-input" onchange="switchMode(this)" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Client Copy</label>
                    </div>
                </div>
                <div class="col-md-6 text-md-end mt-0 mt-md-5">
                    <p class="text-info fw-bolder" style="font-size: 25px;">請求書</p>
                    <p class="text-secondary"><?php echo date('Y年m月d日') ?></p>
                </div>
            </div>

            <hr style="border: 1px solid black;">

            <!-- Inquiry Details Section -->
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
                                <td>1</td>
                                <td><?php echo date("Y年m月d日", $acceptedInfo["accepted_start_date"]) ?></td>
                                <td><?php echo date("Y年m月d日", $acceptedInfo["accepted_completed_date"]) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table">
                        <thead class="table-primary">
                            <th style="font-size: 17px;" colspan="2">仕事の状態</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="fw-bolder">状態：</th>
                                <?php
                                // Display status based on inquiry status
                                if ($inquiryInfo["inquiry_status"] == 1) {
                                    echo ' <td class="text-danger">未完了</td>';
                                }
                                if ($inquiryInfo["inquiry_status"] == 2) {
                                    echo ' <td class="text-success">完了</td>';
                                } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Customer Information Section -->
            <div class="row">
                <div class="col-md-5">
                    <table class="table table-customer-information">
                        <thead class="table-info">
                            <th style="font-size: 17px;" colspan="2">顧客情報</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="fw-bolder">名前：</th>
                                <td><?php echo $acceptedInfo["accepted_client_name"] ?></td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">連絡先番号：</th>
                                <td><?php echo $inquiryInfo["client_number"] ?></td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">電話/メール</th>
                                <td>電話</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">住所：</th>
                                <td><?php echo $acceptedInfo["accepted_location"] ?></td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">契約金額：</th>
                                <td><?php echo number_format($acceptedInfo["accepted_contract"]) ?> 円</td>
                            </tr>
                            <tr>
                                <th class="fw-bolder">作業依頼：</th>
                                <td>
                                    <?php
                                    $wo_id = $inquiryInfo["client_wo"];
                                    echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $wo_id")->fetch_assoc()["work_name"];
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7 mt-4 mt-md-0">
                    <label for="context" class="fw-bolder">作業依頼のコンテキスト</label>
                    <textarea class="form-control" style="border: 2px solid black; width: 100%;" name="" id="context" cols="40" rows="7" readonly><?php echo $inquiryInfo["client_comment"] ?></textarea>
                </div>
            </div>
            <table id="expense_table" class="table table-bordered table-responsive text-center">
                <thead class="table-danger">
                    <tr>
                        <th colspan="5">経費</th>
                    </tr>
                </thead>
                <thead style="text-transform: uppercase;">
                    <tr>
                        <th>#</th>
                        <th>タイトル</th>
                        <th>価格</th>
                        <th>数量</th>
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
                        $subtotal = $row["expense_price"] * $row["expense_quantity"];
                        $total = $total + $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $row["expense_title"]?></td>
                            <td><?php echo $row["expense_price"] ?>¥</td>
                            <td><?php echo $row["expense_quantity"]; ?></td>
                            <td><?php echo number_format($subtotal) ?>¥</td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"></th>
                        <th>合計：<?php echo number_format($total); ?> 円</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th>総利益：<?php echo number_format($acceptedInfo["accepted_contract"] - $total); ?> 円</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>

    </html>

<?php endif ?>

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