<?php 
    include('assets/includes/header.php')
?>
<title> Contact | Dr. Prince Nwosa - Speaker, Motivator, Scholar & Writer.</title>

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
                            <h1 data-animation="fadeInLeft" data-delay=".6s ">Contact Me</h1>
                            <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a href="home">Home</a></li>
                                            <li class="breadcrumb-item active"><a>Contact</a></li>
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
    <!-- Slider Area End -->
    <!--?  Contact Area start  -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-50">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-5 offset-lg-1 mb-30">
                    <div class="media contact-info">
                        <div class="contact_author contact_frame contact-img ">
                            <img class="img-fluid" src="assets/img/author/prince-nwosa.jpg" alt="">
                            <div class="social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <div class="col-lg-6">
                <h2 class="form-intro">Message </h2>
                <h2 class="form-author">Prince N Nwosa </h2>
                    <form class="form-contact contact_form" action="contact_process.php" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" name="submit_form" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                <!-- <div class="col-lg-5 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Buttonwood, California.</h3>
                            <p>Rosemead, CA 91770</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+1 253 565 2365</h3>
                            <p>Mon to Fri 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>support@colorlib.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div> -->
               
            </div>
        </div>
    </section>
    <!-- Contact Area End -->
</main>
<?php
    include('assets/footer.php');
    include('assets/includes/footscript.php')
    ?>


</body>
</html>