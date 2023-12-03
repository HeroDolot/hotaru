<?php
// Includes
include '../includes/header.php';
// Components
include '../components/navbar.php';
?>

<style>
    .hero-blog {
        text-transform: uppercase;
        font-size: 22px;
    }
</style>

<div class="container-fluid d-flex justify-content-end" style="padding-top: 150px;">  
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fw-bolder fs-5">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
    </nav>
</div>

<section class="container">
    <p class="text-primary fw-bolder fs-1 mb-2">Blog</p>
    <div class="row">
        <!-- MAIN BLOG -->
        <div class="col-md-7">
            <div class="card mb-3">
                <img src="../img/throw.webp" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
        <!-- MAIN BLOG -->

        <!-- SUB MAIN BLOG -->
        <div class="col-md-5">
            <div class="card mb-3">
                <div class="card-body p-0">
                    <div class="row g-1">
                        <div class="col-md-7">
                            <img src="../img/sample-2.jpg" class="img-fluid rounded" alt="">
                        </div>
                        <div class="col-md-5">
                            <div class="wrapper">
                                <p class="card-header">Card title</p>
                                <p class="p-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis, nesciunt impedit rerum vitae</p>
                            </div>
                        </div>
                        <div class="card-footer m-0">
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body p-0">
                    <div class="row g-1">
                        <div class="col-md-7">
                            <img src="../img/sample-2.jpg" class="img-fluid rounded" alt="">
                        </div>
                        <div class="col-md-5">
                            <div class="wrapper">
                                <p class="card-header">Card title</p>
                                <p class="p-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis, nesciunt impedit rerum vitae</p>
                            </div>
                        </div>
                        <div class="card-footer m-0">
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body p-0">
                    <div class="row g-1">
                        <div class="col-md-7">
                            <img src="../img/sample-2.jpg" class="img-fluid rounded" alt="">
                        </div>
                        <div class="col-md-5">
                            <div class="wrapper">
                                <p class="card-header">Card title</p>
                                <p class="p-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis, nesciunt impedit rerum vitae</p>
                            </div>
                        </div>
                        <div class="card-footer m-0">
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SUB MAIN BLOG -->

    <hr>
    <!-- SECONDARY BLOG -->
    <div class="text-primary fw-bolder mt-4 mb-3">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="card">
                    <img src="../img/sample-3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../img/sample-3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../img/sample-3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../img/sample-3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include '../includes/footer.php'
?>