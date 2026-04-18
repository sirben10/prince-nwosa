<?php

$today = date('d-m-Y');
$lunchsql .= " order by lunchID desc LIMIT 1";
$query = mysqli_query($con, $lunchsql);
$lunchrows=mysqli_fetch_array($query);


?>

<div class="slider-area slider-bg">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider d-flex align-items-center slider-height ">
            <div class="container">
                <?php
                if (!empty($lunchrows) && strtotime($today) < strtotime($lunchrows['luncDate'])) { ?>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-5 col-lg-5 col-md-9 ">
                            <div class="hero__caption">
                                <span data-animation="fadeInLeft" data-delay=".3s">Latest Publication by Dr. Prince N. Nwosa</span>
                                <h1 data-animation="fadeInLeft" data-delay=".6s "><?php echo $lunchrows['bookTitle'] ?></h1>
                                <p data-animation="fadeInLeft" data-delay=".8s">Effecient Strateegies for High Impact Delivery
                                </p>
                                <!-- Slider btn -->
                                <div class="lunch-on">
                                    Launching ON <?php echo date('D', strtotime($lunchrows['luncDate'])) . ', ' . date('d-m-Y', strtotime($lunchrows['luncDate'])) ?>
                                </div>
                                <div id="timer"></div>
                                <div class="slider-btns">
                                    <!-- Hero-btn -->
                                    <a data-animation="fadeInLeft" data-delay="1s" href="book_lunch?book=<?php echo $lunchrows['bookTitle'] ?>" class="btn radius-btn">see details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="hero__img d-none d-lg-block f-right justify-content-center">
                                <img src="../app/lunchingFiles/<?php echo $lunchrows['bookCover'] ?>" class="" alt="" data-animation="fadeInRight" data-delay="1s">
                                <!-- <img src="assets/img/hero/hero-img_.png" class="" alt="" data-animation="fadeInRight" data-delay="1s"> -->
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2"></div>
                    </div>
                <?php }
               else if (!empty($bookrows)) { ?>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xl-5 col-lg-5 col-md-9 ">
                            <div class="hero__caption">
                                <span data-animation="fadeInLeft" data-delay=".3s">Latest Publication by Dr. Prince N. Nwosa</span>
                                <h1 data-animation="fadeInLeft" data-delay=".6s "><?php echo ucwords($bookrows['bookTitle']) ?></h1>
                                <p data-animation="fadeInLeft" data-delay=".8s">Effecient Strateegies for High Impact Delivery
                                </p>
                                <!-- Slider btn -->
                               
                                <div class="slider-btns">
                                    <!-- Hero-btn -->
                                    <a data-animation="fadeInLeft" data-delay="1s" href="books?book=<?php echo $bookrows['bookURL'] ?>" target="_blank" class="btn radius-btn">see details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="hero__img d-none d-lg-block f-right justify-content-center">
                                <img src="../app/bookCover/<?php echo $bookrows['bookCover'] ?>" class="" alt="" data-animation="fadeInRight" data-delay="1s">
                                <!-- <img src="assets/img/hero/hero-img_.png" class="" alt="" data-animation="fadeInRight" data-delay="1s"> -->
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Single Slider -->
        <div class="single-slider d-flex align-items-center slider-height ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-9 ">
                        <div class="hero__caption">
                            <span data-animation="fadeInLeft" data-delay=".3s">Speaker, Motivator, Scholar & Writer</span>
                            <h1 data-animation="fadeInLeft" data-delay=".6s">Dr. Prince N. Nwosa</h1>

                            <!-- Slider btn -->
                            <div class="slider-btns">
                                <!-- Hero-btn -->
                                <a data-animation="fadeInLeft" data-delay="1s" href="about_author" class="btn radius-btn">know more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero__img d-none d-lg-block f-right">
                            <img src="assets/img/author/prince_.png" alt="" data-animation="fadeInRight" data-delay="1s">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Shape -->
    <div class="slider-shape d-none d-lg-block">
        <img class="slider-shape1" src="assets/img/hero/top-left-shape.png" alt="">
    </div>
</div>