<?php
include './connection.php';
include './includes/header.php';

// Components
include './components/navbar.php';
?>

<style>
  
</style>

<section class="section-first">
    <div class="overlay"></div>
    <div class="container">
        <h1 class="d-flex align-items-center justify-content-center  py-5 mt-5">Hotaru Services</h1>
        <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis voluptatibus rerum quas aliquam quasi illum minima incidunt laudantium cumque at eum iure perspiciatis expedita soluta accusamus, recusandae sapiente quidem.</p>
    </div>
</section>



<div class="container-fluid py-5 p-5 d-flex justify-content-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active fw-bold fs-5" aria-current="page">Home</li>
        </ol>
    </nav>
</div>

<section>
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-md-6 mt-0 mt-md-5">
                <h3><span class="text-primary">Company Name</span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora magni deserunt omnis vitae ipsa reprehenderit laboriosam sapiente animi dolores eligendi velit, repudiandae maxime nesciunt dolore, doloribus quasi ex atque laborum?</h3>
                <button class="btn btn-primary fs-5 mt-3" onclick="window.location.href='./pages/inquiry.php'">Inquire</button>
            </div>
            <div class="col-md-6 mt-5 mt-md-0">
                <img src="./img/landing_img_1.webp" class="img-fluid" alt="">
            </div>
        </div>
        <button id="scrollTopBtn" onclick="scrollToTop()">Top</button>

</section>
<hr>
<section class="section-second">
    <div class="overlay"></div>
    <div class="container">
        <h1 class="d-flex align-items-center justify-content-center  py-5 mt-5">Our Services</h1>
        <div class="wrapper mt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <div class="image-container">
                                <img src="./img/sample-1.jpg" class="img-fluid" alt="">
                                <div class="overlay">
                                    <h4 class="fw-bolder">Moving Service</h4>
                                    <div class="additional-info">
                                        <p>Additional text goes here</p>
                                        <a href="#" class="btn btn-primary">Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <div class="image-container">
                                <img src="./img/clean.webp" class="img-fluid" alt="">
                                <div class="overlay">
                                    <h4 class="fw-bolder">Cleaning Service</h4>
                                    <div class="additional-info">
                                        <p>Additional text goes here</p>
                                        <a href="#" class="btn btn-primary">Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <div class="image-container">
                                <img src="./img/throw.webp" class="img-fluid" alt="">
                                <div class="overlay">
                                    <h4 class="fw-bolder">Throw</h4>
                                    <div class="additional-info">
                                        <p>Additional text goes here</p>
                                        <a href="#" class="btn btn-primary">Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section style="background: url('./img/sample-1.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="container py-3">
        <div class="d-flex justify-content-center align-items-center text-white">
            <h3>Our Services</h3>
        </div>
        <div class="wrapper mt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <div class="image-container">
                                <img src="./img/sample-1.jpg" class="img-fluid" alt="">
                                <div class="overlay">
                                    <h4 class="fw-bolder">Moving Service</h4>
                                    <div class="additional-info">
                                        <p>Additional text goes here</p>
                                        <a href="#" class="btn btn-primary">Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <div class="image-container">
                                <img src="./img/clean.webp" class="img-fluid" alt="">
                                <div class="overlay">
                                    <h4 class="fw-bolder">Cleaning Service</h4>
                                    <div class="additional-info">
                                        <p>Additional text goes here</p>
                                        <a href="#" class="btn btn-primary">Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card card-custom">
                        <div class="card-body p-0">
                            <div class="image-container">
                                <img src="./img/throw.webp" class="img-fluid" alt="">
                                <div class="overlay">
                                    <h4 class="fw-bolder">Throw</h4>
                                    <div class="additional-info">
                                        <p>Additional text goes here</p>
                                        <a href="#" class="btn btn-primary">Inquire</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div> -->


<script>
    // Function to scroll to the top of the page
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Show/hide the button based on scroll position
    window.onscroll = function() {
        toggleScrollTopButton();
    };

    function toggleScrollTopButton() {
        var button = document.getElementById("scrollTopBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }
</script>


<?php
include './includes/footer.php'
?>