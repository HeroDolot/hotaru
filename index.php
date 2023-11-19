<?php
include './connection.php';
include './includes/header.php';

// Components
include './components/navbar.php';
?>

<style>
    .section-first {
        position: relative;
        background: url('./img/hero-img.jpg') no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        min-height: 700px;
        overflow: hidden;
        /* Ensure the overlay doesn't overflow */
    }

    .overlay {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        /* Adjust the alpha value for the desired opacity */
        z-index: 1;
        /* Ensure the overlay is above the background image */
    }

    .section-first .container {
        position: relative;
        z-index: 2;
        /* Ensure the text is above the overlay */
        color: white;
        /* Adjust text color for readability */
        text-align: center;
        padding: 20px;
    }

    #scrollTopBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 50%;
        padding: 10px;
        cursor: pointer;
        font-size: 18px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
        z-index: 999;
    }

    #scrollTopBtn:hover {
        background-color: #0056b3;
    }

    .section-second {
        position: relative;
        background: url('./img/sample-1.jpg') no-repeat center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        min-height: 700px;
        overflow: hidden;
        /* Ensure the overlay doesn't overflow */
    }

    .section-second::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: url('./img/sample-1.jpg') no-repeat center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        z-index: -1;
    }

    .overlay {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        /* Adjust the alpha value for the desired opacity */
        z-index: 1;
        /* Ensure the overlay is above the background image */
    }

    .section-second .container {
        position: relative;
        z-index: 2;
        /* Ensure the text is above the overlay */
        color: white;
        /* Adjust text color for readability */
        text-align: center;
        padding: 20px;
    }
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