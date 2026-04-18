<title> Dr. Prince Nwosa - Project Management Expert, Speaker, Motivator, Scholar & Writer.</title>
<?php
if (!empty($authorrows)) {?>
<div class="about-area1 pb-bottom mt-100">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="about-caption about-caption3 mb-50">
                        <h2 data-animation="fadeInUp">About the Author</h2>
                        <!-- Section Tittle -->
                        <div class="section-head section-head2 mb-30">
                            <h1 data-animation="fadeInLeft">    <?php echo ucwords($authorrows['academicTitle']. ' '. $authorrows['authorName'])?></h1>
                        </div>
                        <p class="mb-40" data-animation="fadeInUp">
                        <?php echo stripcslashes($authorrows['authorBio']); ?>
                        <!-- <?php echo substr(strip_tags(stripcslashes($row['authorBio'])), 0, 200); ?>... -->
                            
                        </p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-8 col-sm-10">
                    <!-- about-img -->
                    <div class="contact_frame contact-img ">
                            <img class="img-fluid" src="assets/img/author/prince-nwosa.jpg" alt="">
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>