<title>Admin Dashboard | Assets</title>
<?php
session_start();

include("../connection.php");

if (isset($_POST["add_item"])) {
    var_dump($_POST);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dateAcquired = strtotime(mysqli_real_escape_string($conn, $_POST['dateAcquired']));
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    mysqli_query($conn, "INSERT INTO assets(asset_name,asset_date_acquired,asset_quantity) VALUES('$name',$dateAcquired,$quantity)");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./assets.php?success=Asset has been added!");
    } else {
        header("location:./assets.php?error=Asset failed to add!");
    }
}

if (isset($_POST["delete_asset"])) {
    $asset_id = mysqli_real_escape_string($conn, $_POST["delete_asset"]);
    mysqli_query($conn, "DELETE FROM assets WHERE asset_id = $asset_id");
    if (mysqli_affected_rows($conn) == 1) {
        header("location:./assets.php?success=Asset has been deleted!");
    } else {
        header("location:./assets.php?error=Asset failed to delete!");
    }
}

include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assets</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="wrapper mb-3 mt-md-0">
        <?php
        if (isset($_GET["success"])) {
            echo '<div class="alert alert-success" role="alert">' . mysqli_real_escape_string($conn, $_GET["success"]) . '</div>';
        }

        if (isset($_GET["error"])) {
            echo '<div class="alert alert-danger" role="alert">' . mysqli_real_escape_string($conn, $_GET["error"]) . '</div>';
        }

        ?>
        <div class="d-flex justify-content-between">
            <h4 class="fw-bolder text-primary">Hotaru Services Assets</h4>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal">
                <i class="fa-solid fa-plus"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" required name="name" placeholder="Item Name">
                                </div>
                                <div class="mb-3">
                                    <label for="dateAcquired" class="form-label">Date Acquired</label>
                                    <input type="date" class="form-control" required name="dateAcquired">
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" required name="quantity" placeholder="Quantity">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" required name="price" placeholder="Price">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="add_item" class="btn btn-primary">Save</button>
                            </div>
                        </form>F
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-responsive table-bordered table-info table-alternate align-middle">
        <thead>
            <th>Name</th>
            <th>Date Acquire</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM assets");
            while ($row = $result->fetch_assoc()) :
            ?>
                <tr>
                    <td><?php echo $row["asset_name"] ?></td>
                    <td><?php echo date("M d, Y", $row["asset_date_acquired"]) ?></td>
                    <td><?php echo $row["asset_quantity"] ?></td>
                    <td>17,000¥</td>
                    <td>
                        <div class="wrapper d-flex justify-content-center align-items-center">
                            <form method="POST" class="col-md-12">
                                <button type="submit" name="delete_asset" value="<?php echo $row["asset_id"] ?>" class="btn btn-danger col-12 col-md-5">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div>


<?php
include './includes/footer.php';
?>