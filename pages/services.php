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
            <li class="breadcrumb-item active" aria-current="page">Services</li>
        </ol>
    </nav>
</div>

<section class="container">
    <p class="text-primary fw-bolder fs-1 mb-2">Company Services</p>

    <div class="row">
        <div class="col-md-6">
            <img src="../img/truck.jpg" class="img-fluid" alt="truck">
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
    <div class="container-fluid pb-5" style="background-color: #f2f2f2;">
        <div class="text-center text-primary fw-bolder fs-1 mt-4 mb-3 py-5">
            Featured Services
        </div>
        <div class="row g-3">
            <div class="col-md-3 p-2">
                <div class="card p-3 shadow">
                    <div class="card-text">
                        <div class="text-center">
                            <img src="../img/sample-2.jpg" class="img-fluid" alt="">
                        </div>
                        <h4 class="text-center mt-3">Moving Services</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam facilis ex harum sequi impedit veritatis, eligendi a autem culpa labore aliquam quos, minus commodi iusto, quae quis nulla neque provident?</p>
                        <a class="text-decoration-none d-block text-center" href="#">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card p-3 shadow">
                    <div class="card-text">
                        <div class="text-center">
                            <img src="../img/sample-2.jpg" class="img-fluid" alt="">
                        </div>
                        <h4 class="text-center mt-3">Moving Services</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam facilis ex harum sequi impedit veritatis, eligendi a autem culpa labore aliquam quos, minus commodi iusto, quae quis nulla neque provident?</p>
                        <a class="text-decoration-none d-block text-center" href="#">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card p-3 shadow">
                    <div class="card-text">
                        <div class="text-center">
                            <img src="../img/sample-2.jpg" class="img-fluid" alt="">
                        </div>
                        <h4 class="text-center mt-3">Moving Services</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam facilis ex harum sequi impedit veritatis, eligendi a autem culpa labore aliquam quos, minus commodi iusto, quae quis nulla neque provident?</p>
                        <a class="text-decoration-none d-block text-center" href="#">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 p-2">
                <div class="card p-3 shadow">
                    <div class="card-text">
                        <div class="text-center">
                            <img src="../img/sample-2.jpg" class="img-fluid" alt="">
                        </div>
                        <h4 class="text-center mt-3">Moving Services</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam facilis ex harum sequi impedit veritatis, eligendi a autem culpa labore aliquam quos, minus commodi iusto, quae quis nulla neque provident?</p>
                        <a class="text-decoration-none d-block text-center" href="#">Learn More</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>



<?php
include '../includes/footer.php'
?>