<?php
include './connection.php';
$currentDate = strtotime(date("Y-m-d") . "00:00:00");
$res = mysqli_query($conn, "SELECT * FROM page_count WHERE count_date = $currentDate");
if ($res->num_rows == 0) {
    mysqli_query($conn, "INSERT INTO page_count (count_date,count) VALUES($currentDate,1)");
} else {
    mysqli_query($conn, "UPDATE page_count SET count = count + 1 WHERE count_date = $currentDate");
}

include './includes/header.php';

// Components
// include './components/navbar.php';
?>


<div class="fixed-top">
    <nav class="navbar navbar-expand bg-body-tertiary p-3" id="scrollNavbar" style="display: none;">
        <div class="container-fluid">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <button class="nav-link active" aria-current="page" href="#">Home</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" href="#" onclick="scrollToSection('section-second')">Services</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" href="#" onclick="scrollToSection('blog')">Blog</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" href="#" onclick="scrollToSection('testimony')">Testimonies</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" href="#" onclick="scrollToSection('flow')">Flow</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" href="#" onclick="scrollToSection('inquiry')">Inquire</button>
                </li>
            </ul>
        </div>
    </nav>
</div>
<section class="bg-dark text-white p-3">
    <div class="container-fluid">
        <div class="wrapper d-flex justify-content-between">
            <h4 style="color:#C5F656; letter-spacing:5px;">TRUE LINK COMPANY</h4>
            <p class="text-end fw-bolder fs-5" style="letter-spacing: 7px;">070-4797-8099</p>
        </div>
    </div>
</section>

<section class="female-introduction d-none d-md-block">

</section>

<section class="female-introduction-mobile d-sm-none d-md-none">
    <div class="py-4 p-4">
        <h1 class="fw-bolder" style="text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">引っ越しを計画していますか？</h1>
    </div>

    <div class="container">
        <div class="col-md-6" style="margin-top: 7em;">
            <div class="wrapper fw-bolder fs-5" style="text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">
                <div class="row gap-4">
                    <div class="col-12">
                        ・捨てたい家具や、燃えないゴミを不良品回収します。
                    </div>
                    <div class="col-12">
                        ・少しでも迷ってるなら、相談して下さい。ご相談は無料です。
                    </div>
                    <div class="col-12">
                        ・捨て方のアドバイスも承ります。
                    </div>
                </div>
            </div>
            <div class="wrapper fw-bolder mt-3" style="font-size:40px; text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">
                おまかせください！
            </div>
        </div>

        <div class="col-12 mt-3">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="row fw-bolder" style="text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">
                    <div class="col-7">
                        <p class="text-center" style="color:#00BF63; font-size:30px;">お手ごろな価格</p>
                    </div>
                    <div class="col-3">
                        <p class="text-center" style="color:#FF914D; font-size:30px">速い</p>
                    </div>
                    <div class="col-12">
                        <p class="text-center" style="color:#38B6FF; font-size:30px">安全な</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-first">
    <div class="overlay"></div>
    <div class="container">
        <h1 class="d-flex align-items-center justify-content-center  py-5 mt-5">Hotaru Services</h1>
        <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam blanditiis voluptatibus rerum quas aliquam quasi illum minima incidunt laudantium cumque at eum iure perspiciatis expedita soluta accusamus, recusandae sapiente quidem.</p>
    </div>
</section>


<!-- 
<section class="hero-section" style="min-height:700px; background-color:#efefd0;">

    <div class="container-fluid py-5 p-5 d-flex justify-content-end">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active fw-bold fs-5" aria-current="page">Home</li>
            </ol>
        </nav>
    </div>

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
</section> -->

<section class="why-Hotaru" id="why-Hotaru" style="min-height: 810px; background-color:#f9f9f9;">
    <div class="container py-5">
        <p class="text-primary fw-bolder" style="font-size: 17px; text-transform:uppercase;">なぜ私たちを選ぶのですか？</p>
        <div class="container">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card shadow" style="min-height: 178px;">
                        <div class="card-body">
                            <div class="card-img-top text-center">
                                <img src="./icons/handle-with-care.png" alt="Handle With Care Icon">
                            </div>
                            <div class="card-text text-center">
                                お客様の大切なものを心を込めて取り扱います。安心してお任せください。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top text-center">
                                <img src="./icons/cash.png" alt="Affordable Icon">
                            </div>
                            <div class="card-text text-center">
                                手頃な価格で高品質のサービスを提供します。予算にやさしいオプションをご用意しています。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top text-center">
                                <img src="./icons/truck-fast.png" alt="Fast Icon">
                            </div>
                            <div class="card-text text-center">
                                迅速で効率的なサービスをお約束します。大切な日程に合わせて迅速に対応いたします。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top text-center">
                                <img src="./icons/secure.png" alt="Secure Icon">
                            </div>
                            <div class="card-text text-center">
                                お客様のデータや財産を安全に保護します。セキュリティに配慮したサービスを提供しています。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top text-center">
                                <img src="./icons/language.png" alt="Bilingual Icon">
                            </div>
                            <div class="card-text text-center">
                                多言語対応で、日本語が分からない方ともスムーズにコミュニケーションいたします。言葉の壁を感じさせません。
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top text-center">
                                <img src="./icons/group.png" alt="Professional Team Icon">
                            </div>
                            <div class="card-text text-center">
                                プロフェッショナルなチームがお客様のサポートに尽力します。信頼性と高い技術力を備えたチームがお手伝いいたします。
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="call-to-action-section overflow-hidden bg-dark" style="min-height: 150px;;">
    <div class="py-5">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card card-call-to-action" style="min-height: 158px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <img src="./icons/contact-us.png" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-7 col-9 mt-2">
                                <div class="card-title">
                                    <p class="fw-bolder fs-5">Contact Us Now!</p>
                                </div>
                                <p class="card-text fw-bolder text-primary p-contact" style="letter-spacing:3px;">070-4797-8099</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card card-call-to-action" style="min-height: 148px;">
                    <button type="button" class="btn btn-outline-none btn-bg-none text-start" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-3">
                                    <img src="./icons/line.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-7 col-9 mt-2">
                                    <div class="card-title">
                                        <p class="fw-bolder fs-3">Connect us through <span class="fw-bolder" style="letter-spacing: 3px; color:#00C300!important;">LINE</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel"><img src="./icons/line.png" alt="Line App">Connect with us through <span style="letter-spacing: 3px; color:#00C300">LINE</span> App!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container py-3">
                                        <!-- <div class="row"> -->
                                        <!-- <div class="col-md-6 col-6 fw-bolder">
                                                <div class="card mb-3 mb-md-0">
                                                    <div class="card-body p-0">
                                                        <img src="./img/ken_qr.jpg" class="img-fluid" alt="Ken Line QR CODE">
                                                        <div class="card-footer">
                                                            Ken Suzuki
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        <div class="fw-bolder">
                                            <div class="card">
                                                <div class="card-body text-center p-0">
                                                    <img src="./img/hotaru_qr.jpg" class="img-fluid" alt="Hotaru Line QR CODE">
                                                    <div class="card-footer">
                                                        Hotaru
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-call-to-action" style="min-height: 158px;">
                    <button href="#" onclick="scrollToSection('inquiry')" class="border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-3">
                                    <img src="./icons/email.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-7 col-9 mt-2">
                                    <div class="card-title">
                                        <p class="fw-bolder fs-5">Send us an Email!</p>
                                    </div>
                                    <p class="card-text fw-bolder text-primary p-contact" style="letter-spacing:3px;">Free Estimate</p>
                                </div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="promotion" style="min-height:80px; background-color: red;">
    <?php
    $sqlPromotion = "SELECT * FROM updates WHERE update_location = 'Promotion'";
    $result = mysqli_query($conn, $sqlPromotion);

    // Check if the query was successful
    if ($result) {
        // Fetch the data as an associative array
        $rowUpdates = mysqli_fetch_assoc($result);

        // Check if there is any data
        if ($rowUpdates) {
    ?>
            <div class="container">
                <div class="d-flex justify-content-center align-items-center">
                    <p class="mt-4 text-white fw-bolder fs-3"><?php echo $rowUpdates['update_description']; ?></p>
                </div>
            </div>
    <?php
        } else {
            // Handle case when no data is found
            echo "<p>No promotions yet.</p>";
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Handle the case when the query fails
        echo "Error: " . mysqli_error($conn);
    }
    ?>

</section>
<section class="section-second" id="section-second">
    <div class="container-fluid pb-5" style="background-color: #f2f2f2; min-height: 1080px;">
        <div class="container">
            <div class="text-primary text-start fw-bolder mt-4 mb-3 py-5" style="font-size:44px; letter-spacing:5px;">
                私たちのサービス
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <img src="./img/sample-3.jpg" class="img-fluid rounded" alt="Image for Moving Services">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-5">
                    <p class="fw-bolder fs-4 text-primary">引越しサービス</p>
                    <p class="text-secondary">引越しは大変ですが、私たちはプロの手でスムーズに新しい場所へお引越しをサポートします。安心して新生活を始めましょう。</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <p class="fw-bolder fs-4 text-primary">廃棄物処理サービス</p>
                    <p class="text-secondary">環境に優しい廃棄物処理サービス。不要な物を効果的に処理し、エコフレンドリーな解決策を提供します。地球と共に未来につなげましょう。</p>
                </div>
                <div class="col-md-6 d-none d-md-block mb-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <img src="./img/throw.webp" class="img-fluid rounded" alt="Image for Disposal Services">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-sm-block d-md-none">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <img src="./img/throw.webp" class="img-fluid rounded" alt="Image for Disposal Services">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-sm-block d-md-none mb-3 mb-md-5">
                    <p class="fw-bolder fs-4 text-primary">廃棄物処理サービス</p>
                    <p class="text-secondary">環境にやさしい廃棄物処理サービス。不要なものをスムーズに手配し、エコフレンドリーな方法でリサイクルいたします。地球環境への貢献を共にしましょう。</p>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <img src="./img/clean.webp" class="img-fluid rounded" alt="Image for Cleaning Services">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-5">
                    <p class="fw-bolder fs-4 text-primary">クリーニングサービス</p>
                    <p class="text-secondary">プロの手によるクリーニングサービス。清潔で快適な空間を提供し、お客様の日常生活をより良くするお手伝いを致します。</p>
                </div>
            </div> -->
        </div>
    </div>
    <button class="btn" id="scrollTopBtn" onclick="scrollToTop()">
        <img src="./icons/arrow-up-1.png" class="img-fluid" alt="">
    </button>
</section>


<section class="container py-5" id="blog">
    <p class="text-primary fw-bolder mb-2" style="font-size:44px; letter-spacing:5px;">ブログ</p>
    <div class="row">
        <!-- MAIN BLOG -->
        <?php
        $row = mysqli_query($conn, "SELECT * FROM updates WHERE update_location = 'Main Blog'")->fetch_assoc();

        ?>
        <div class="col-md-7">
            <div class="card mb-3">
                <img src="<?php echo $row["update_image"] ?>" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row["update_title"] ?></h5>
                    <p class="card-text"><?php echo $row["update_description"] ?></p>
                    <p class="card-text"><small class="text-body-secondary">
                            <?php
                            $blogPostTimestamp = $row["update_date"]; // Replace this with your blog post's timestamp

                            // Current timestamp
                            $currentTimestamp = time();

                            // Calculate the difference in seconds
                            $timeDifferenceSeconds = $currentTimestamp - $blogPostTimestamp;

                            // Convert seconds to minutes and hours
                            $minutes = floor($timeDifferenceSeconds / 60);
                            $hours = floor($timeDifferenceSeconds / 3600);
                            $days = floor($hours / 24);

                            if ($days > 0) {
                                if ($days == 1) {
                                    echo "Last update " . $days . " day ago.";
                                } else {
                                    echo "Last update " . $days . " days ago.";
                                }
                            } else {
                                if ($hours > 0) {
                                    echo "Last update " . $hours . " hours ago.";
                                } else {
                                    echo "Last update " . $minutes . " minutes ago.";
                                }
                            }

                            ?>
                        </small></p>
                </div>
            </div>
        </div>
        <!-- MAIN BLOG -->

        <!-- SUB MAIN BLOG -->
        <div class="col-md-5">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM updates WHERE update_location = 'Sub Main Blog' limit 3");
            while ($row = $result->fetch_assoc()) :
            ?>

                <div class="card mb-3">
                    <div class="card-body p-0">
                        <div class="row g-1">
                            <div class="col-md-7">
                                <img src="<?php echo $row["update_image"] ?>" class="img-fluid rounded" alt="">
                            </div>
                            <div class="col-md-5">
                                <div class="wrapper">
                                    <p class="card-header"><?php echo $row["update_title"] ?></p>
                                    <p class="p-2"><?php echo $row["update_description"] ?></p>
                                </div>
                            </div>
                            <div class="card-footer m-0">
                                <p class="card-text"><small class="text-body-secondary">
                                        <?php
                                        $blogPostTimestamp = $row["update_date"]; // Replace this with your blog post's timestamp

                                        // Current timestamp
                                        $currentTimestamp = time();

                                        // Calculate the difference in seconds
                                        $timeDifferenceSeconds = $currentTimestamp - $blogPostTimestamp;

                                        // Convert seconds to minutes and hours
                                        $minutes = floor($timeDifferenceSeconds / 60);
                                        $hours = floor($timeDifferenceSeconds / 3600);
                                        $days = floor($hours / 24);

                                        if ($days > 0) {
                                            if ($days == 1) {
                                                echo "Last update " . $days . " day ago.";
                                            } else {
                                                echo "Last update " . $days . " days ago.";
                                            }
                                        } else {
                                            if ($hours > 0) {
                                                echo "Last update " . $hours . " hours ago.";
                                            } else {
                                                echo "Last update " . $minutes . " minutes ago.";
                                            }
                                        }

                                        ?>
                                    </small></p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile ?>

        </div>
    </div>
    <!-- SUB MAIN BLOG -->

    <hr>
    <!-- SECONDARY BLOG -->
    <!-- CONVERT TO CAROUSEL -->
    <div class="text-primary fw-bolder mt-4 mb-3">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM updates WHERE update_location = 'Secondary Blog'");
        ?>
        <div id="updateCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php
                $first = true;
                while ($row = $result->fetch_assoc()) :
                ?>
                    <div class="carousel-item<?php echo $first ? ' active' : '' ?>">
                        <img src="<?php echo $row["update_image"] ?>" class="d-block img-fluid" style="height: 75vh; width:100%;" alt="...">
                        <div class="carousel-caption">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-footer">
                                        <h5><?php echo $row["update_title"] ?></h5>
                                        <p><?php echo $row["update_description"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $first = false;
                endwhile;
                ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#updateCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#updateCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<style>

</style>
<section class="testimony bg-half-blue" id="testimony" style="min-height: 1080px;">
    <div class="container text-white py-5">
        <p class="fw-bolder" style="font-size:55px; letter-spacing:5px;">VOICE</p>
        <hr>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-7">

                <?php
                $result = mysqli_query($conn, "SELECT * FROM reviews WHERE is_deleted = 0 limit 3");
                while ($row = $result->fetch_assoc()) :
                    $service_id = $row["review_service"];
                ?>
                    <div class="card text-white fw-bolder mb-3" style="background-color: #EF6F6C;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5 col-5">
                                    <!--<img src="./icons/testi-male.png" class="img-fluid" alt="">-->
                                    <img src="<?php echo $row["review_image"]; ?>" class="img-fluid rounded" alt="">

                                    <div class="row container fw-bolder fs-4">
                                        <p class="fs-5"><?php echo mysqli_query($conn, "SELECT * FROM work_order WHERE work_id = $service_id")->fetch_assoc()["work_name"]; ?></p>
                                        <div class="col-md-4 col-9">
                                            <p><?php echo $row["review_age"] ?>歳</p>
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <div class="star-rating">
                                                <?php
                                                if ($row["review_star"] >= 1) {
                                                    echo '<label for="star1">&#9733;</label>';
                                                }
                                                if ($row["review_star"] >= 2) {
                                                    echo '<label for="star2">&#9733;</label>';
                                                }
                                                if ($row["review_star"] >= 3) {
                                                    echo '<label for="star3">&#9733;</label>';
                                                }
                                                if ($row["review_star"] >= 4) {
                                                    echo '<label for="star4">&#9733;</label>';
                                                }
                                                if ($row["review_star"] == 5) {
                                                    echo '<label for="star5">&#9733;</label>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-7 p-0 m-0">
                                    <div class="container mt-3">
                                        <p class="fw-bolder fs-3"><?php echo $row["review_title"] ?></p>
                                        <hr style="border: 1px solid white;">
                                        <p style="font-family: 'Passion One', sans-serif; font-size:35px;">"</p>
                                        <p style="margin-top: -10px;"><?php echo $row["review_context"] ?></p>
                                        <p class="text-end" style="font-family: 'Passion One', sans-serif; font-size:35px; margin-top:-20px; margin-right: 25px;">"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile ?>


            </div>
        </div>
    </div>
</section>

<section class="call-to-action-section overflow-hidden bg-dark" style="min-height: 150px;">
    <div class="py-5">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card card-call-to-action" style="min-height: 158px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <img src="./icons/contact-us.png" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-7 col-9 mt-2">
                                <div class="card-title">
                                    <p class="fw-bolder fs-5">Contact Us Now!</p>
                                </div>
                                <p class="card-text fw-bolder text-primary p-contact" style="letter-spacing:3px;">070-4797-8099</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card card-call-to-action" style="min-height: 148px;">
                    <button type="button" class="btn btn-outline-none btn-bg-none text-start" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-3">
                                    <img src="./icons/line.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-7 col-9 mt-2">
                                    <div class="card-title">
                                        <p class="fw-bolder fs-3">Connect us through <span class="fw-bolder" style="letter-spacing: 3px; color:#00C300!important;">LINE</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel"><img src="./icons/line.png" alt="Line App">Connect with us through <span style="letter-spacing: 3px; color:#00C300">LINE</span> App!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container py-3">
                                        <div class="row">
                                            <div class="col-md-6 col-6 fw-bolder">
                                                <div class="card mb-3 mb-md-0">
                                                    <div class="card-body p-0">
                                                        <img src="./img/ken_qr.jpg" class="img-fluid" alt="Ken Line QR CODE">
                                                        <div class="card-footer">
                                                            Ken Suzuki
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 fw-bolder">
                                                <div class="card">
                                                    <div class="card-body p-0">
                                                        <img src="./img/hotaru_qr.jpg" class="img-fluid" alt="Hotaru Line QR CODE">
                                                        <div class="card-footer">
                                                            Hotaru
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-call-to-action" style="min-height: 158px;">
                    <button href="#" onclick="scrollToSection('inquiry')" class="border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-3">
                                    <img src="./icons/email.png" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-7 col-9 mt-2">
                                    <div class="card-title">
                                        <p class="fw-bolder fs-5">Send us an Email!</p>
                                    </div>
                                    <p class="card-text fw-bolder text-primary p-contact" style="letter-spacing:3px;">Free Estimate</p>
                                </div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flow" id="flow" style="background-color: #f2f2f2;">
    <div class="container py-5">
        <p class="fw-bolder text-primary mt-5" style="font-size:44px; letter-spacing:5px;">フロー</p>
        <div class="container d-flex align-items-center justify-content-center py-3">
            <div class="col-md-7">
                <div class="row mb-5">
                    <div class="col-md-2 col-4">
                        <img src="./icons/flow-mobile-phone.png" class="img-fluid" alt="Mobile Phone Icon">
                    </div>
                    <div class="col-md-10 col-8">
                        <p class="fw-bolder text-primary text-center fs-4">ステップ1 - お問い合わせ</p>
                        <hr style="border: 2px solid;" class="text-black">
                        <p class="fw-bolder fs-5">電話、メール、LINEでのご予約を承っています。</p>
                        <div class="wrapper justify-content-center align-items-center d-flex">
                            <img src="./icons/flow-arrow-down.png" style="height: 60px; width:75px;" alt="Arrow Down Icon">
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-2 col-4">
                        <img src="./icons/flow-schedule.png" class="img-fluid" alt="Schedule Icon">
                    </div>
                    <div class="col-md-10 col-8">
                        <p class="fw-bolder text-primary text-center fs-4">ステップ2 - スケジュール確認</p>
                        <hr style="border: 2px solid;" class="text-black">
                        <p class="fw-bolder fs-5">契約価格の見積もりとスケジュールの確認のため、ご連絡させていただきます。</p>
                        <div class="wrapper justify-content-center align-items-center d-flex">
                            <img src="./icons/flow-arrow-down.png" style="height: 60px; width:75px;" alt="Arrow Down Icon">
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-2 col-4">
                        <img src="./icons/flow-start-work.png" class="img-fluid" alt="Start Work Icon">
                    </div>
                    <div class="col-md-10 col-8">
                        <p class="fw-bolder text-primary text-center fs-4">ステップ3 - 作業開始</p>
                        <hr style="border: 2px solid;" class="text-black">
                        <p class="fw-bolder fs-5">作業当日、到着予定時刻をお知らせするために事前にお電話いたします。効率的かつスムーズに作業を完了させることを目指します。</p>
                        <div class="wrapper justify-content-center align-items-center d-flex">
                            <img src="./icons/flow-arrow-down.png" style="height: 60px; width:75px;" alt="Arrow Down Icon">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-4">
                        <img src="./icons/flow-payment-yen.png" class="img-fluid" alt="Payment Icon">
                    </div>
                    <div class="col-md-10 col-8">
                        <p class="fw-bolder text-primary text-center fs-4">ステップ4 - 支払い</p>
                        <hr style="border: 2px solid;" class="text-black">
                        <p class="fw-bolder fs-5">作業完了時にお支払いが必要で、現金のみ受け付けております。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="area">
    <div class="container">
        <p class="fw-bolder mt-5" style="font-size:44px; letter-spacing:5px;">解体工事対応エリア

        </p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card border-success">
                    <div class="card-header fs-3 fw-bolder">
                        千葉県
                    </div>
                    <div class="card-body fs-5">
                        ・ 千葉市・中央区・花見川区・稲毛区・若葉区・緑区・美浜区・銚子市・市川市・船橋市・館山市・木更津市・松戸市・野田市・茂原市・成田市・佐倉市・東金市・旭市・習志野市・柏市・ ・勝浦市・市原市・流山市・八千代市・我孫子市・鴨川市・鎌ヶ谷市・君津市・富津市・浦安市・四街道市・袖ヶ浦市・八街市・印西市・白井市・富里市・南房総市・匝瑳市・香取市・山武市・いすみ市 ・大網白里市・酒々井町・栄町・神崎町・多古町・東庄町・九十九里町・芝山町・横芝光町・一宮町・睦沢町・白子町・長柄町・長南町・大多喜町・御宿町・鋸南町
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-success mb-3" style="min-height: 364px;">
                    <div class="card-header fs-3 fw-bolder">
                        東京都
                    </div>
                    <div class="card-body fs-5">
                        ・千代田区・中央区・港区・新宿区・文京区・台東区・墨田区・江東区・品川区・目黒区・大田区・世田谷区・渋谷区・中野区・杉並区・豊島区・北区・荒川区・板橋区・練馬区・足立区・葛飾区・江戸川区 ・八王子市・立川市・武蔵野市・三鷹市・青梅市・府中市・昭島市・調布市・町田市・小金井市・小平市・日野市・東村山市・国分寺市・国立市・福生市 ・狛江市・東大和市・清瀬市・東久留米市・武蔵村山市・多摩市・稲城市・羽村市・あきる野市・西東京市・瑞穂町・日の出町・ 檜原村・奥多摩町
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-success mb-3">
                    <div class="card-header fs-3 fw-bolder">
                        埼玉県
                    </div>
                    <div class="card-body fs-5">
                        ・さいたま市・西区・北区・大宮区・見沼区・中央区・桜区・浦和区・南区・緑区・岩槻区・川越市・熊谷市・川口市・行田市・秩父市・所沢市・飯能市・加須市・本庄市・東松山市・春日部市・狭山市 ・羽生市・鴻巣市・深谷市・上尾市・草加市・越谷市・蕨市・戸田市・入間市・朝霞市・志木市・和光市・新座市・桶川市・久喜市・北本市・八潮市・富士見市・三郷市・蓮田市・坂戸市 ・幸手市・鶴ヶ島市・日高市・吉川市・ふじみ野市・白岡市・伊奈町・三芳町・毛呂山町・越生町・滑川町・嵐山町・小川町・川島町・吉見町・鳩山町・ときがわ町・横瀬町・皆野町・長瀞町 ・小鹿野町・東秩父村・美里町・神川町・上里町・寄居町・宮代町・杉戸町・松伏町 </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-success" style="min-height: 423px;">
                    <div class="card-header fs-3 fw-bolder">
                        茨城県
                    </div>
                    <div class="card-body fs-5">
                        ・水戸市・日立市・土浦市・古河市・石岡市・結城市・龍ヶ崎市・下妻市・常総市・常陸太田市・高萩市・北茨城市・笠間市・取手市・牛久市・つくば市・ひたちなか市・鹿嶋市・潮来市 ・守谷市・常陸大宮市・那珂市・筑西市・坂東市・稲敷市・かすみがうら市・桜川市・神栖市・行方市・鉾田市・つくばみらい市・小美玉市・茨城町・大洗町・城里町・東海村・大子町 ・美浦村・阿見町・河内町・八千代町・五霞町・境町・利根町 </div>
                </div>
            </div>
        </div>
</section>
<hr>


<section class="container py-5" id="inquiry">
    <p class="fw-bolder mt-5" style="font-size:44px; letter-spacing:5px;">問い合わせる</p>
    <div class="row">
        <div class="col-md-7">
            <img src="./img/inquiry-img.jpg" class="img-fluid d-md-none d-sm-block" alt="inquiry">
            <div class="card" style="background-color: #f3f3f3;">
                <div class="card-header fw-bolder fs-3">
                    問い合わせる
                </div>
                <div class="card-body">
                    <form action="./controller/inquiry_conn.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="clientEmail" placeholder="name@example.com" required>
                            <label for="floatingInput">メールアドレス</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingName" name="clientName" placeholder="Name" required>
                            <label for="floatingInputGroup1">名前</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInputGroup1" name="clientNumber" placeholder="Contact Number" required>
                            <label for="floatingInputGroup1">連絡先番号 </label>
                        </div>
                        <div class="container mb-3">
                            <small class="fw-bolder">ご希望は、お電話か、メールどちらが、ご希望ですか？</small>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="border-color:#0D78FC;" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Call" required>
                                <label class="form-check-label" for="inlineRadio1">お電話か</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="border-color:#0D78FC;" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Mail" required>
                                <label class="form-check-label" for="inlineRadio2">メールどちらが</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" style="border-color:#0D78FC;" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Call/Mail" required>
                                <label class="form-check-label" for="inlineRadio3">どちらも</label>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="clientRegion" aria-label="Floating label select example" required>
                                <option selected disabled>地域を選択してください</option>
                                <option value="Kanto">関東</option>
                            </select>
                            <label for="floatingSelect">地域を選択</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="clientWO" required>
                                <option selected disabled value="">作業オーダーを選択してください</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM work_order");
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["work_id"] . '">' . $row["work_name"] . '</option>';
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">作業オーダーを選択</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="追加情報" id="floatingTextarea2" name="clientComment" style="height: 100px" required></textarea>
                            <label for="floatingTextarea2">追加情報</label>
                        </div>
                        <div class="container m-0">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" style="border: 1px solid black;" required>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            <small>チェックボックスを選択することで、当社のデータプライバシーポリシーに同意し、お客様のデータの保護を確認します。</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="clientInquirySubmit">送信する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 d-none d-md-block">
            <img src="./img/inquiry-img.jpg" class="img-fluid" alt="inquiry">
        </div>
    </div>
</section>

<div id="scrollCard" class="card border-primary col-md-6 col-7">
    <div class="container">
        <div class="card-body text-center">
            <h5 class="card-title text-primary">Contact Us Now!</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        070-4797-8099
                    </div>
                    <div class="col-md-6">
                        a
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./js/index.js"></script>
<?php
include './includes/footer.php'
?>