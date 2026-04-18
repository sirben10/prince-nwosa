<?php 
    include('assets/includes/header.php')
?>
</head>
   <!-- ? Preloader Start -->
   <?php 
    include('assets/preloader.php')
    ?>
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
        <?php 
        include('assets/nav.php')
        ?>
    <!-- Header End -->
</header>
<main>
    <!-- Slider Area Start-->
    <div class="slider-area slider-bg ">
        <!-- Single Slider -->
        <div class="single-slider d-flex align-items-center slider-height3">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-12 ">
                        <div class="hero__caption hero__caption3 text-center">
                            <h1 data-animation="fadeInLeft" data-delay=".6s ">About</h1>
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
   
    <?php 
    include('assets/about-author.php')
    ?>
</main>
<?php 
  include('assets/footer.php');
  include('assets/includes/footscript.php')
  ?>
</body>
</html>