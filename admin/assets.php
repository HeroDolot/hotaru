<?php
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
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Item Name">
                                </div>
                                <div class="mb-3">
                                    <label for="dateAcquired" class="form-label">Date Acquired</label>
                                    <input type="date" class="form-control" id="dateAcquired">
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" placeholder="Quantity">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
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
            <th>Action</th>
        </thead>
        <tbody>
            <tr>
                <td>Belt Carrier</td>
                <td>Oct 5, 2023</td>
                <td>3</td>
                <td>
                    <div class="wrapper d-md-flex justify-content-around d-sm-none">
                        <button type="submit" class="btn btn-primary col-12 col-md-5 mb-3 mb-md-0">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="submit" class="btn btn-danger col-12 col-md-5">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
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