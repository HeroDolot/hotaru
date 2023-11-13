<?php
// Includes
include '../includes/header.php';
// Components
include '../components/navbar.php';
?>

<div class="container-fluid py-5 p-5 d-flex justify-content-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bolder fs-5">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>
</div>

<section class="container">
    <p class="text-primary fw-bolder fs-1 mb-2">About Us</p>

    <div class="row">
        <div class="col-md-6">
            <img src="../img/truck.jpg" class="img-fluid" alt="truck">
        </div>
        <div class="col-md-6 fs-5">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea, debitis tempore laboriosam enim maxime vel mollitia blanditiis cum sint dolores ipsam impedit, dignissimos saepe eum id. Magnam eum eos soluta?Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet eos minima vitae aperiam voluptates explicabo dolorum repellat incidunt delectus quos, animi autem nostrum optio quae dolore rerum. Qui, sunt quidem.
        </div>
    </div>
    <hr>
    <div class="text-center fw-bolder fs-3 mt-4 mb-3">
        Our services
    </div>
        <div class="container py-3">
            <div class="card col-md-6">
                <img src="../img/sample-1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">この量の家電製品の価格は約です</p>
                    <p class="card-text">ken yappari hentai</p>
                    <p class="card-text">ken oshiri daisuki</p>
                    <p class="card-text">¥50,000</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" onclick="window.location.href='./inquiry.php'">Inquire</button>
                </div>
            </div>
        </div>
</section>



<?php
include '../includes/footer.php'
?>