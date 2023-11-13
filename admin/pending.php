<?php
include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pending</li>
        </ol>
    </nav>
</div>


<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-bordered table-danger align-middle">
            <thead>
                <th>#</th>
                <th>Date</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Location</th>
                <th>W.O</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Oct 27, 2023</td>
                    <td>Ken Suzuki</td>
                    <td>09123456789</td>
                    <td>Saitama, Satte</td>
                    <td>Relocation</td>
                    <td>
                        <div class="badge text-bg-danger">
                            Pending
                        </div>
                    </td>
                    <td>
                        <div class="wrapper d-md-flex justify-content-around d-sm-none">
                            <button type="submit" class="btn btn-primary col-12 col-md-5 mb-3 mb-md-0">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button type="submit" class="btn btn-danger col-12 col-md-5">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Oct 27, 2023</td>
                    <td>Ken Suzuki</td>
                    <td>09123456789</td>
                    <td>Saitama, Satte</td>
                    <td>Relocation</td>
                    <td>
                        <div class="badge text-bg-danger">
                            Pending
                        </div>
                    </td>
                    <td>
                        <div class="wrapper d-md-flex justify-content-around d-sm-none">
                            <button type="submit" class="btn btn-primary col-12 col-md-5 mb-3 mb-md-0">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button type="submit" class="btn btn-danger col-12 col-md-5">
                                <i class="fa-solid fa-xmark"></i>
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
</div>

<?php
include './includes/footer.php';
?>