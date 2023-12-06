<?php
session_start();
include("../connection.php");

if (isset($_GET["id"])) :
    $inquiry_id = mysqli_real_escape_string($conn, $_GET["id"]);
    $info = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_id = $inquiry_id")->fetch_assoc();

    $accepted = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();


?>

    <title>Admin Dashboard | Pending Report</title>
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
                    <p class="fw-bolder" style="font-size: 55px;"><span class="text-primary">Hotaru</span> Services</p>
                </div>
                <p class="text-secondary">Company Address</p>
                <div class="form-check form-switch">
                    <input class="form-check-input" onchange="switchMode(this)" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Client Copy</label>
                </div>
            </div>
            <div class="col-md-6 text-md-end mt-0 mt-md-5">
                <p class="text-info fw-bolder" style="font-size:25px;">INVOICE</p>
                <p class="text-secondary"><?php echo date('d F Y') ?></p>
            </div>
        </div>
        <hr style="border: 1px solid black;">
        <div class="row py-4 d-flex justify-content-between">
            <div class="col-md-4">
                <table class="table text-center table-responsive align-middle">
                    <thead class="table-info">
                        <th>#</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $accepted["accepted_id"] ?>
                            </td>
                            <td><?php echo date('M d, Y', $accepted["accepted_start_date"]) ?></td>
                            <td class="text-danger">Data Unavailable</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-md-4">
                <table class="table">
                    <thead class="table-primary">
                        <th style="font-size: 17px;" colspan="3">Job Result</th>
                    </thead>
                    <tbody>
                        <tr class="fw-bolder">
                            <th>Status:</th>
                            <td class="text-danger">Pending</td>
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
                        <th style="font-size: 17px;" colspan="2">Customer Information</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="fw-bolder">Name:</th>
                            <td><?php echo $accepted["accepted_client_name"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Contact Number:</th>
                            <td><?php echo $info["client_number"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Call/Email</th>
                            <td><?php echo $info["preferred_contact"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Address:</th>
                            <td><?php echo $accepted["accepted_location"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Contract Amount:</th>
                            <td><?php echo number_format($accepted["accepted_contract"]) ?> YEN</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Work Order:</th>
                            <td><?php echo $info["client_wo"] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-7 mt-4 mt-md-0"> <!-- Added margin top for smaller screens -->
                <label for="context" class="fw-bolder">Work order Context</label>
                <textarea class="form-control" style="border: 2px solid black; width: 100%;" name="" id="context" cols="40" rows="7" readonly><?php echo $info["client_comment"] ?></textarea>
            </div>
            <table id="expense_table" class="table table-bordered table-responsive text-center">
                <thead class="table-danger">
                    <tr>
                        <th colspan="5" style="letter-spacing:5px;">EXPENSES</th>
                    </tr>
                </thead>
                <thead style="text-transform: uppercase;">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $count = 0;
                    $result = mysqli_query($conn, "SELECT * FROM expense_history WHERE exp_history_inquiry_id = $inquiry_id");
                    while ($row = $result->fetch_assoc()) :
                        $count++;
                        $expense_history_id = $row["exp_history_expense_id"];
                        $subtotal = $row["exp_history_price"] * $row["expense_quantity"];
                        $total = $total + $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo mysqli_query($conn, "SELECT * FROM expense_type WHERE expense_id = $expense_history_id")->fetch_assoc()["expense_name"] ?></td>
                            <td><?php echo $row["exp_history_price"] ?>¥</td>
                            <td><?php echo $row["expense_quantity"]; ?></td>
                            <td><?php echo number_format($subtotal) ?>¥</td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"></th>
                        <th>Total: <?php echo number_format($total);?>¥</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th>Total Profit: <?php echo number_format($accepted["accepted_contract"] - $total);?>¥</th>
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