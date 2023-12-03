<?php
// Includes
include '../includes/header.php';
// Components
include '../components/navbar.php';
?>

<div class="container-fluid  d-flex justify-content-end" style="padding-top: 150px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bolder fs-5">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol>
    </nav>
</div>

<section class="container" style="min-height: 650px;">
    <p class="text-primary fw-bolder fs-1 mb-2">Company Services</p>

    <div class="row">
        <div class="col-md-6">
            <img src="../img/truck.jpg" class="img-fluid mb-3 mb-md-0 rounded" alt="truck">
        </div>
        <div class="col-md-6 fs-5">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ea, debitis tempore laboriosam enim maxime vel mollitia blanditiis cum sint dolores ipsam impedit, dignissimos saepe eum id. Magnam eum eos soluta?Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet eos minima vitae aperiam voluptates explicabo dolorum repellat incidunt delectus quos, animi autem nostrum optio quae dolore rerum. Qui, sunt quidem.
            <div class="col-md-12 mt-3">
                <a href="./inquiry.php" class="btn btn-primary">Inquire Now</a>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid pb-5" style="background-color: #f2f2f2; min-height: 1080px;">
        <div class="container">
            <div class="text-primary fw-bolder fs-4 mt-4 mb-3 py-5">
                Featured Services
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <img src="../img/sample-3.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-5">
                    <p class="fw-bolder fs-4 text-primary">Moving Services</p>
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id minus iusto ipsa quia sapiente odio, nisi accusantium ipsum earum architecto exercitationem eum eaque vel cum minima, animi et. Quo, a.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <p class="fw-bolder fs-4 text-primary">Disposal Services</p>
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id minus iusto ipsa quia sapiente odio, nisi accusantium ipsum earum architecto exercitationem eum eaque vel cum minima, animi et. Quo, a.</p>
                </div>
                <div class="col-md-6 d-none d-md-block mb-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="../img/throw.webp" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-sm-block d-md-none">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <img src="../img/throw.webp" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-sm-block d-md-none mb-3 mb-md-5">
                    <p class="fw-bolder fs-4 text-primary">Disposal Services</p>
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id minus iusto ipsa quia sapiente odio, nisi accusantium ipsum earum architecto exercitationem eum eaque vel cum minima, animi et. Quo, a.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <img src="../img/clean.webp" class="img-fluid rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-5">
                    <p class="fw-bolder fs-4 text-primary">Cleaning Services</p>
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id minus iusto ipsa quia sapiente odio, nisi accusantium ipsum earum architecto exercitationem eum eaque vel cum minima, animi et. Quo, a.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include '../includes/footer.php'
?>