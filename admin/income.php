<?php
include './includes/header.php';
include './components/navbar.php';
?>

<div class="container-fluid py-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bold fs-3">
            <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Income</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <canvas id="salesChart"></canvas>
        </div>
        <div class="col-md-4 col-12 mt-5">
            <h4 class="fw-bolder">Recent Work Orders</h4>
            <table class="table table-responsive table-bordered table-info table-alternate">
                <thead>
                    <th>Name</th>
                    <th>Date</th>
                    <th>WO</th>
                    <th>Income</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Ken Suzuki</td>
                        <td>Oct 1, 2023</td>
                        <td>Relocation</td>
                        <td>¥700,000</td>
                        <th>
                            <a class="btn btn-info text-white">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </th>
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
</div>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Sales Data
    const months = ['January', 'February', 'March', 'April', 'May'];
    const salesData = [1000, 1200, 1500, 1100, 1400];

    // Line Chart Data
    const data = {
        labels: months,
        datasets: [{
            label: 'Sales',
            data: salesData,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 5
        }]
    };

    // Line Chart Configuration
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Create and render the Line Chart
    const myChart = new Chart(ctx, config);
</script>

<?php
include './includes/footer.php';
?>