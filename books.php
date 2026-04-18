<?php include('assets/includes/header.php');
if (!empty($_GET['book'])) {
    $bookURL = $_GET['book'];
    $bookssql .= "WHERE bookURL = '$bookURL'";
    // echo  $bookssql ; exit;
    $query = mysqli_query($con, $bookssql);
    $resultt = mysqli_fetch_array($query);
}
if (!empty($resultt)) {?>
    <title> <?php echo ucwords($resultt['bookTitle'])?>.</title>
<?php }
?>


<title> Books | Dr. Prince Nwosa - Speaker, Motivator, Scholar & Writer.</title>

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
                                    Books</h1>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="home">Home</a></li>
                                        <?php if (!empty($resultt)) { ?>
                                            <li class="breadcrumb-item"><a href="books">Books</a></li>
                                            <li class="breadcrumb-item active"><a><?php echo ucwords($resultt['bookTitle']) ?></a></li>

                                        <?php  } else { ?>
                                            <li class="breadcrumb-item"><a href="books">Books</a></li> <?php }  ?>
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
        <section class="books-card-area books-card-area2 section-padding40">
            <div class="container">
                <?php
                if (!empty($bookURL && !empty($resultt))) { ?>
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                            <img class="img-fluid" src="app/bookCover/<?php echo $resultt['bookCover']; ?>" alt="">
                            <h3 class="text-center mt-lg-5"><a href="about_author" style="text-decoration: underline !important; color: #1f2b7b" title="About the Author">About the Author <i class="fas fa-arrow-right"></i></a></h3>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mt-lg-100">
                            <p class="mt-50 text-justify px-5 mb-50"><?php echo $resultt['bookDesc']; ?></p>
                            <p class="mt-20 px-5">Published <?php echo $resultt['publishedYear']; ?></p>
                            <div class="buy-online px-5">
                                <div class="buy_title mt-50">Buy online from</div>
                                <div class="mechant">
                                    <a href="http://" target="_blank" rel="noopener noreferrer"> Amazon <i class=" fab fa-amazon"></i> </a>
                                    <a href="http://" target="_blank" rel="noopener noreferrer"> Selar <img src="assets/img/merchant/sela.png" alt=""> </a>
                                    <?php 
                                    if (!empty($resultt['freeBook'])) {?>
                                        <a href="#" data-toggle="modal" data-target="#requestModal">Free Pages  </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>

                    <div class="row">
                        <?php
                        while ($books = mysqli_fetch_array($bookquery)) {
                        ?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <div class="single-card text-center mb-30">
                                    <div class="card-top ">
                                        <div class="card-img">
                                            <img class="img-fluid" src="app/bookCover/<?php echo $books['bookCover']; ?>" alt="">
                                        </div>

                                        <a href="?book=<?php echo $books['bookURL']; ?>">
                                            <h4><?php echo ucwords($books['bookTitle']); ?></h4>
                                        </a>
                                        <p>Published <?php echo $books['publishedYear']; ?></p>
                                    </div>

                                    <div class="card-bottom">
                                        <!-- <p><?php echo substr($books['bookDesc'], 0, strpos($books['bookDesc'], " ", 100)) ?>...</p>
                                <a href="?book=<?php echo $books['bookID'] ?>" class="borders-btn">More</a> -->
                                    </div>
                                </div>
                            </div>
                        <?php }  ?>
                    </div>
                <?php } ?>
            </div>
        </section>

        <?php
         $sql= "SELECT * from book_review r
		 JOIN books b ON b.bookID = r.bookID WHERE b.bookURL = '$bookURL'";
         $query = mysqli_query($con, $sql);
        //  echo $sql; exit;
         $checkrow=mysqli_fetch_array($query);

         if (!empty($resultt) && !empty($checkrow)) { ?>

            <!-- Review -->
            <section class="ask-questions section-bg1 section-padding10 fix">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-9 col-md-10 ">
                            <!-- Section Tittle -->
                            <div class="section-tittle text-center mt-100 mb-100">
                                <h2 class="text-center">What Readers Says about <br> </h2>
                                    <h3 class=" text-light"><?php echo ucwords($resultt['bookTitle']) ?></h3>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <section class="testimonial-area section-bg1">
                    <div class="container">
                        <div class="testimonial-wrapper">
                            <div class="row align-items-center justify-content-center">
                                <div class=" col-lg-10 col-md-12 col-sm-11">
                                    <!-- Testimonial Start -->
                                    <div class="h1-testimonial-active">
                                        <!-- Single Testimonial -->

                                        <?php 
                                       
                                        // echo $sql; exit;
                                        $querry = mysqli_query($con, $sql);
                                        while($row=mysqli_fetch_array($querry))
                                        {?>
                                            <div class="single-testimonial text-center mt-55">
                                                <div class="testimonial-caption">
                                                    <img src="assets/img/icon/quotes-sign.png" alt="" class="quotes-sign">
                                                    <p><?php echo $row['reviewText']; ?></p>
                                                </div>
                                                <!-- founder -->
                                                <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                                
                                                    <div class="founder-text">
                                                        <span><?php echo ucwords($row['reviewedBy']); ?></span>
                                                        <p><?php echo $row['otherDetails']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <!-- Single Testimonial -->
                                    </div>
                                    <!-- Testimonial End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        <?php } ?>


        <!-- Want To work End 2-->
    </main>
    <!-- Scroll Up -->
    <?php
    include('assets/footer.php');
    include('assets/includes/footscript.php')
    ?>

</body>

</html>