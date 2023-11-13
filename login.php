<?php 
include './includes/header.php'; 
include "./connection.php";

if (isset($_POST['userLoginSubmit'])) {
    // Retrieve user input
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // Query to check user credentials
    $query = "SELECT * FROM user WHERE user_email = '$user_email' AND user_password = '$user_password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check if a matching user is found
        if (mysqli_num_rows($result) > 0) {
            // Start a session and set session variables
            session_start();
            $_SESSION['user_email'] = $user_email;
            // You can set more session variables as needed

            // Redirect to a logged-in page
            header('Location: ../../hotaru/admin/index.php');
            exit();
        } else {
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "Database error: " . mysqli_error($conn);
    }
}

// Close the database connection when done
mysqli_close($conn);
?>

<div class="row">
    <div class="col-md-6">
        <div class="container">
            <img src="../hotaru/img/moved.webp" class="img-fluid d-none d-md-block" alt="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="container">
            <div class="container d-flex justify-content-center align-items-center vh-100 vh-sm-0">
                <div class="card col-md-8 col-9 shadow-lg">
                    <div class="card-header fw-bolder fs-3 p-4 bg-primary text-white text-center">
                        <a href="./index.php" class="text-white text-decoration-none">Hotaru Services</a>
                    </div>
                    <div class="card-body">
                        <form action="/hotaru/login.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="user_email" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" name="user_password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="wrapper d-flex justify-content-center align-items-center">
                                <button type="submit" name="userLoginSubmit" class="btn btn-primary mt-3 col-md-5 col-6 fw-bolder">Login</button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the slanted background element -->