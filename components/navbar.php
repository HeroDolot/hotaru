<style>
    /* Additional styling for improved appearance */
    .offcanvas-body {
        background-color: #f8f9fa;
        /* Set a background color */
        padding: 20px;
        /* Add some padding */
    }

    .offcanvas-text {
        font-size: 1.2rem;
        color: #555;
    }

    .navbar-brand {
        color: #fff;
        /* Set the color of the brand */
    }

    .navbar-toggler {
        border: none;
        /* Remove border from the toggler */
    }

    .navbar-toggler-icon {
        background-color: #fff;
        /* Set the color of the toggler icon */
    }

    .navbar-nav .nav-link {
        color: #333;
        /* Set the color of the navigation links */
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
        /* Change color on hover */
    }

    .navbar-nav .active {
        font-weight: bold;
        /* Highlight the active link */
    }
</style>

<div class="fixed-top">
    <section class="bg-dark text-white p-3">
        <div class="container-fluid">
            <div class="wrapper d-flex justify-content-between">
                <!-- <p class="fw-bolder fs-5">TRUE LINK</p> -->
                <h4 style="color:#C5F656; letter-spacing:5px;">TRUE LINK COMPANY</h4>
                <p class="text-end fw-bolder fs-5" style="letter-spacing: 7px;">070-4797-8099</p>
            </div>
        </div>
    </section>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand fs-3" href="../../hotaru/index.php">
                <i class="fa-solid fa-square-h fa-2xl text-primary"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel" style="width: 100%;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarOffcanvasLabel">Menu</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body offcanvas-links d-flex flex-column align-items-center justify-content-center text-center mx-auto mx-sm-0">
                    <ul class="navbar-nav mb-2 mb-lg-0 d-flex justify-content-end ms-auto">
                        <li class="nav-item fs-5">
                            <a class="nav-link active" aria-current="page" href="../../hotaru/index.php">Home</a>
                        </li>
                        <li class="nav-item fs-5">
                            <a class="nav-link" href="../../hotaru/pages/services.php">Services</a>
                        </li>
                        <li class="nav-item fs-5">
                            <a class="nav-link" href="../../hotaru/pages/about.php">About</a>
                        </li>
                        <li class="nav-item fs-5">
                            <a class="nav-link" href="../../hotaru/pages/blog.php">Blog</a>
                        </li>
                        <li class="nav-item fs-5">
                            <a class="nav-link" href="../../hotaru/pages/inquiry.php">Inquiry</a>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-body offcanvas-call d-flex align-items-center justify-content-center text-center d-md-none">
                    <p class="offcanvas-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad vitae iste eum eius, itaque saepe sit ipsum perferendis ab, neque deleniti earum, veniam non doloremque quis molestias eos quia nesciunt!
                    </p>
                </div>
            </div>
        </div>
    </nav>
</div>