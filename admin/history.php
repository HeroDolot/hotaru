<?php
include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">History</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-success text-center align-middle">
            <thead>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Mail Address</th>
                <th>Region</th>
                <th>Work Order</th>
                <th>Status</th>
            </thead>
            <tbody>
                <tr>
                    <td>Ken Suzuki</td>
                    <td>09123456789</td>
                    <td>mail@mail.com</td>
                    <td>Kanto</td>
                    <td>Relocation</td>
                    <td>
                        <div class="badge text-bg-success">
                            Completed
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Ken Suzuki</td>
                    <td>09123456789</td>
                    <td>mail@mail.com</td>
                    <td>Saitama, Satte Shi</td>
                    <td>Relocation</td>
                    <td>
                        <div class="badge text-bg-danger">
                            Pending
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