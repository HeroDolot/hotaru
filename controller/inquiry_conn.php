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
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sssssss", $clientEmail, $clientName, $clientNumber, $clientRegion, $clientwo, $clientComment, $clientPreferredContact);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Data inserted successfully
            header('location:../index.php#inquiry');
        } else {
            // Handle errors
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle errors
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
