<?php include('assets/includes/header.php');

// echo $select_images; exit;
    $query = mysqli_query($con, $select_images);


?>


<title> Gallery | <?php echo $title; ?> - Speaker, Motivator, Scholar & Writer.</title>

</head>

<body>
    <!-- ? Preloader Start -->
    <?php
    include('assets/preloader.php')
    ?>
    <!-- Preloader Stop -->
    <header>
        <!-- Header Start -->
        <?php
        include('assets/nav.php')
        ?>
        <!-- Header End -->
    </header>
    <!-- header end -->
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area slider-bg ">
            <!-- Single Slider -->
            <div class="single-slider d-flex align-items-center slider-height3">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8 col-lg-9 col-md-12 ">
                            <div class="hero__caption hero__caption3 text-center">
                                <h1 data-animation="fadeInLeft" data-delay=".6s ">
                                    Gallery</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item "><a href="home">Home</a></li>
                                            <li class="breadcrumb-item active">Gallery</li> 
                                    </ol>
                                </nav>
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
        <!-- Hero Area End-->
        <!--? Pricing Card Start -->
        <section class=" section-padding40">
            <div class="container">
                <div class="row">
                        <?php
                        while ($gallery = mysqli_fetch_array($query)) {
                        ?>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="text-center mb-30" >
                                           <a href="app/gallery/<?php echo $gallery['foto']; ?>"> <img style="min-height:300px !important" class="img-fluid" src="app/gallery/<?php echo $gallery['foto']; ?>" alt=""></a>
                                </div>
                            </div>
                        <?php }  ?>
                    </div>
            </div>
        </section>

        

        <!-- Want To work End 2-->
    </main>
    <!-- Scroll Up -->
    <?php
    include('assets/footer.php');
    include('assets/includes/footscript.php')
    ?>

</body>

</html>