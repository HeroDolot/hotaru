<?php
include '../connection.php';

if (isset($_POST['clientInquirySubmit'])) {
    // var_dump($_POST);
    // Retrieve form data
    $clientEmail = $_POST['clientEmail'];
    $clientName = $_POST['clientName'];
    $clientNumber = $_POST['clientNumber'];
    $clientRegion = $_POST['clientRegion'];
    $clientwo = $_POST['clientWO'];
    $clientComment = $_POST['clientComment'];
    $clientPreferredContact = $_POST["inlineRadioOptions"];

    // Prepare and execute the SQL INSERT statement
    $sql = "INSERT INTO inquiry (client_email, client_name, client_number, client_region, client_wo, client_comment, preferred_contact)
            VALUES ('$clientEmail', '$clientName', '$clientNumber', '$clientRegion', '$clientwo', '$clientComment', '$clientPreferredContact')";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
