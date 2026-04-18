<?php
include('assets/includes/header.php');
include('assets/og-image.php');

$launch_date = '03-05-2025';
// $lauch_date = date('d-m-Y', strtotime($launch_date));
$today = date('d-m-Y');
// echo $today; exit;
// echo 'the date '.$launch_date.' is formatted to '. $lauch_date. ' and Today is '. $today; exit;

?>

<style>
    .lunch-on {
        /* padding-top: 1em; */
        font-size: 1.5em;
        font-weight: 100;
        color: white;
        text-shadow: 0 0 20px #48C8FF;
    }

    #timer {
        font-size: 3em;
        font-weight: 100;
        color: white;
        text-shadow: 0 0 20px #48C8FF;

        div {
            display: inline-block;
            min-width: 90px;
            margin-bottom: 0.5em;

            span {
                color: #B1CDF1;
                display: block;
                font-size: .35em;
                font-weight: 400;
            }

        }
    }
</style>
<title><?php echo $title; ?> - Project Management Expert, Speaker, Motivator, Scholar & Writer.</title>
<meta name="google-site-verification" content="epbyYNBkUd_oKWgIZ9M8cNTYGa24yLvp9rQxORz8KVM" />
</head>

<body>
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
        <?php
        include('assets/slider.php')
        ?>
        <!-- Slider Area End -->

        <!--? About-1 Area Start -->
        <div class="about-area1 pb-bottom mt-100">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="about-caption about-caption3 mb-50">
                            <h2 data-animation="fadeInUp">About the Author</h2>
                            <!-- Section Tittle -->
                            <div class="section-head section-head2 mb-30">
                                <h2 data-animation="fadeInLeft">Dr. Prince N. Nwosa</h2>
                            </div>
                            <p class="mb-40" style="line-height: 30px" data-animation="fadeInUp">Dr. Prince Nwosa is a distinguished project management expert with over 25 years of experience delivering successful projects across Africa, the Middle East, Europe, and the United States.<br>
He has led and supported major project initiatives in oil and gas, construction, energy, and technology sectors, earning a reputation for excellence in project delivery, leadership, and stakeholder management.

                            </p>
                            <a href="about_author" class="btn">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-8 col-sm-10">
                        <!-- about-img -->
                        <div class="contact_frame about-img ">
                            <img class="img-fluid" src="assets/img/author/prince-nwosa.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About-1 Area End -->

        <!-- All Books -->


        <section class="books-card-area books-card-area2 section-padding40 ">
            <div class="container">
                <div class="row mt-100">
                    <div class="col-12">
                        <div class="section-head-alt text-center mb-90">
                            <h2>BOOKS</h2>
                        </div>
                    </div>
                    <?php
                    $bookss = $bookssql;
                    $bookss .="order by bookID DESC LIMIT 4";
                    $bookquery = mysqli_query($con, $bookss);
                    $rows = mysqli_num_rows($bookquery);
                    if($rows == 1){
                     $book = mysqli_fetch_array($bookquery)?>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 m-auto">
                        <div class="single-card text-center mb-30">
                            <div class="card-top ">
                                <div class="card-img">
                                    <img class="img-fluid" src="app/bookCover/<?php echo $book['bookCover']; ?>" alt="">
                                </div>
                               <a href="books?book=<?php echo $book['bookURL'] ?>"><h4><?php echo ucwords($book['bookTitle']); ?></h4></a>
                            </div>
                           
                        </div>
                    </div>
                    <?php } else{
                    while ($books = mysqli_fetch_array($bookquery)) {
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="single-card text-center mb-30">
                            <div class="card-top ">
                                <div class="card-img">
                                    <img class="img-fluid" src="app/bookCover/<?php echo $books['bookCover']; ?>" alt="">
                                </div>
                               <a href="books?book=<?php echo $books['bookURL'] ?>"><h4><?php echo ucwords($books['bookTitle']); ?></h4></a>
                            </div>
                           
                        </div>
                    </div>
                    <?php }
                     ?>
                   
                </div>
                <div class="justify-content-center mx-auto text-center">
                               <a href="books" class="btn">Explore <i class="fas fa-arrow-right"></i></a>
                            </div>
                        <?php } ?>
            </div>
        </section>

        <!-- <iframe width="364" height="346" src="https://www.youtube.com/embed/bI9rEnMyrkA" title="Old school tunez 🎧💃🏽 #throwbacktunes" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
 
     
        <!-- End All Books -->

        <!-- Review -->
        <section class="ask-questions section-bg1 section-padding10 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-10 ">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mt-100">
                            <h2 class="text-center">What Readers Says</h2>
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
                                    <div class="single-testimonial text-center mt-55">
                                        <div class="testimonial-caption">
                                            <img src="assets/img/icon/quotes-sign.png" alt="" class="quotes-sign">
                                            <p>Brook presents your services with flexible, convenient and cdpose layouts. You can select your favorite layouts & elements for cular ts with unlimited ustomization possibilities. Pixel-perfect replica;ition of thei designers ijtls intended csents your se.</p>
                                        </div>
                                        <!-- founder -->
                                        <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                           
                                            <div class="founder-text">
                                                <span>Prince N.Nwosa</span>
                                                <p>Speaker, Motivator, Scholar & Writer</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Testimonial -->
                                    <div class="single-testimonial text-center mt-55">
                                        <div class="testimonial-caption">
                                            <img src="assets/img/icon/quotes-sign.png" alt="" class="quotes-sign">
                                            <p>Brook presents your services with flexible, convenient and cdpose layouts. You can select your favorite layouts & elements for cular ts with unlimited ustomization possibilities. Pixel-perfect replica;ition of thei designers ijtls intended csents your se.</p>
                                        </div>
                                        <!-- founder -->
                                        <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                            <div class="founder-text">
                                                <span>Prince N.Nwosa</span>
                                                <p>Speaker, Motivator, Scholar & Writer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial End -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <!-- Articles -->
        <section class="blog_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-5 mb-lg-0">
                        <div class="section-head-alt text-center mb-90">
                            <h2>Articles</h2>
                        </div>
                        <div class="blog_left_sidebar">
                            <div class="row justify-content-center">

                            <?php
                            $articles_query = mysqli_query($con, $articles_sql);
                             while ($articles_row=mysqli_fetch_array($articles_query)) { ?>
                                <div class="col-lg-4">
                                    <article class="blog_item">
                                        <div class="blog_item_img">
                                            <img class="card-img rounded-0" src="app/articlePhotos/<?php echo $articles_row['previewPhoto']; ?>" alt="">
                                            <!-- <a href="#" class="blog_item_date">
                                                <h3>15</h3>
                                                <p>Jan</p>
                                            </a> -->
                                        </div>
                                        <div class="blog_details">
                                            <a class="d-inline-block" href="articles?article=<?php echo $articles_row['articleID']; ?>">
                                                <h2 class="blog-head" style="color: #2d2d2d;"><?php echo ucwords($articles_row['articleTitle']); ?></h2>
                                            </a>
                                            <p><?php echo substr($articles_row['articleDesc'], 0, strpos($articles_row['articleDesc'], ' ', 350)); ?>...</p>
                                            <ul class="blog-info-link">
                                                <li><a href="articles?article=<?php echo $articles_row['articleID']; ?>">Read more <i class="fa fa-arrow-right"></i> </a></li>
                                            </ul>
                                        </div>
                                    </article>
                                </div>
                            <div class="text-center m-auto text-white">
                                <a href="articles" class="btn btn-sm text-white">More Articles <i class="fas fa-arrow-right"></i></a>
                            </div>
                                <?php } ?>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <!-- Scroll Up -->
    <?php
    include('assets/footer.php');
    include('assets/includes/footscript.php')
    ?>
    <script>
        function updateTimer() {
            future = Date.parse("May 03, 2025 10:30:00");
            now = new Date();
            diff = future - now;

            days = Math.floor(diff / (1000 * 60 * 60 * 24));
            hours = Math.floor(diff / (1000 * 60 * 60));
            mins = Math.floor(diff / (1000 * 60));
            secs = Math.floor(diff / 1000);

            d = days;
            h = hours - days * 24;
            m = mins - hours * 60;
            s = secs - mins * 60;

            document.getElementById("timer")
                .innerHTML =
                '<div>' + d + '<span>days</span></div>' +
                '<div>' + h + '<span>hours</span></div>' +
                '<div>' + m + '<span>minutes</span></div>' +
                '<div>' + s + '<span>seconds</span></div>';
        }
        setInterval('updateTimer()', 1000);
    </script>


</body>

</html>