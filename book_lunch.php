<?php include('assets/includes/header.php');
    if(!empty($_GET['book'])){
        $book = $_GET['book'];
        $lunchsql .=" WHERE bookTitle = '$book'";
        // echo $lunchsql; exit;
        $query = mysqli_query($con, $lunchsql);
        $lunch = mysqli_fetch_array($query);
    }
    
?>


<title> Book Lunch | <?php echo $book ?>.</title>

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
                                    </h1>
                               
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
              
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                            <img class="img-fluid" src="app/lunchingFiles/<?php echo  $lunch['flyerDesign']; ?>" alt="">
                        </div>
                         <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 mt-lg-100">
                            <img class="img-fluid mt-50" src="app/lunchingFiles/<?php echo  $lunch['bookCover']; ?>" alt="">
                        </div>
                        <div class="col-xl-4 col-lg-7 col-md-12 col-sm-12 mt-lg-100">
                            <h1 style="font-size:50px; font-weight:bold" class="mt-50"><?php echo $lunch['bookTitle']; ?></h1>
                           
                            <p style="font-weight:bold" class="text-justify mb-30"><?php echo $lunch['bookDesc']; ?></p>
                            <h1 class="mt-20 "><h1 class="d-inline mr-5"><i class="fas fa-map-marker-alt"></i></h1>  <?php echo ucwords($lunch['lunchVenue']); ?> </h1>
                            
                            <h1 class="mt-20 "><h1 class="d-inline mr-5"><i class="fas fa-calendar-alt"></i></h1>  <?php echo date('D', strtotime($lunch['luncDate'])) . ', ' . date('d-m-Y', strtotime($lunch['luncDate']))  ?> </h1>
                            
                         
                            
                        </div>
                           
                    </div>

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