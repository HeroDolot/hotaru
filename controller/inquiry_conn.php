<?php
include '../connection.php';

if (isset($_POST['clientInquirySubmit'])) {
    // Retrieve form data
    $clientEmail = mysqli_real_escape_string($conn, $_POST['clientEmail']);
    $clientName = mysqli_real_escape_string($conn, $_POST['clientName']);
    $clientNumber = mysqli_real_escape_string($conn, $_POST['clientNumber']);
    $clientRegion = mysqli_real_escape_string($conn, $_POST['clientRegion']);
    $clientwo = mysqli_real_escape_string($conn, $_POST['clientWO']);
    $clientComment = mysqli_real_escape_string($conn, $_POST['clientComment']);
    $clientPreferredContact = mysqli_real_escape_string($conn, $_POST["inlineRadioOptions"]);


    // Prepare and execute the SQL INSERT statement using prepared statements
    $sql = "INSERT INTO inquiry (client_email, client_name, client_number, client_region, client_wo, client_comment, preferred_contact)
                        VALUES ('$clientEmail', '$clientName', '$clientNumber', '$clientRegion', $clientwo, '$clientComment', '$clientPreferredContact')";
    mysqli_query($conn,$sql);
    if (mysqli_affected_rows($conn) == 1){
        header('location:../?inquiry=success inquiry');
    } else {
        header('location:../?inquiry=failed to inquire');

    }
}
?>
