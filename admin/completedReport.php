<?php
session_start();
include("../connection.php");
if (isset($_GET["id"])) :
    $inquiry_id = mysqli_real_escape_string($conn, $_GET['id']);
    $inquiryInfo = mysqli_query($conn, "SELECT * FROM inquiry WHERE inquiry_id = $inquiry_id AND inquiry_status >= 1");
    if ($inquiryInfo->num_rows == 1) {
        $inquiryInfo = $inquiryInfo->fetch_assoc();
        $acceptedInfo = mysqli_query($conn, "SELECT * FROM accepted WHERE accepted_inquiry_id = $inquiry_id")->fetch_assoc();
    }
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
                width: 200% !important;
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
            </div>
            <div class="col-md-6 text-md-end mt-0 mt-md-5">
                <p class="text-info fw-bolder" style="font-size:25px;">INVOICE</p>
                <p class="text-secondary"><?php echo date("F d, Y", time()) ?></p>
            </div>
        </div>
        <hr style="border: 1px solid black;">
        <div class="row py-4 d-flex justify-content-between">
            <div class="col-md-4">
                <table class="table table-customer-information">
                    <thead class="table-info">
                        <th style="font-size: 17px;" colspan="2">Customer Information</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="fw-bolder">Name:</th>
                            <td><?php echo $acceptedInfo["accepted_client_name"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Contact Number:</th>
                            <td><?php echo $inquiryInfo["client_number"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Address:</th>
                            <td><?php echo $acceptedInfo["accepted_location"] ?></td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Contract Amount:</th>
                            <td><?php echo number_format($acceptedInfo["accepted_contract"])?> YEN</td>
                        </tr>
                        <tr>
                            <th class="fw-bolder">Work Order:</th>
                            <td><?php echo $inquiryInfo["client_wo"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table">
                    <thead class="table-primary">
                        <th style="font-size: 17px;" colspan="2">Job Result</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="fw-bolder">Status:</th>
                           <?php
                             if ($inquiryInfo["inquiry_status"] == 1){echo ' <td class="text-danger">Pending</td>';}
                             if ($inquiryInfo["inquiry_status"] == 2){echo ' <td class="text-success">Complete</td>';}?>
                             
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <table class="table text-center table-responsive align-middle">
            <thead class="table-info">
                <th>#</th>
                <th>Start Date</th>
                <th>End Date</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td><?php echo date("M d, Y",$acceptedInfo["accepted_start_date"])?></td>
                    <td><?php echo date("M d, Y",$acceptedInfo["accepted_completed_date"])?></td>
                </tr>
            </tbody>
        </table>
    </div>

<?php endif ?>