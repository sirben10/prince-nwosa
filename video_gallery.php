<?php
include('assets/includes/header.php');
$query = mysqli_query($con, $select_videos);
?>

<title> Gallery | <?php echo $title; ?> - Speaker, Motivator, Scholar & Writer.</title>

<style>
    /* === VIDEO CARD === */

    .video-card {
        position: relative;
        width: 100%;
        padding-top: 100%;
        /* 1:1 square */
        overflow: hidden;
        border-radius: 10px;
        background: #000;
        cursor: pointer;
    }

    /* Thumbnail OR Video Preview */

    .video-thumb-img,
    .video-preview-video {

        position: absolute;
        top: 0;
        left: 0;

        width: 100%;
        height: 100%;

        object-fit: cover;
    }

    /* Play Icon */

    .play-icon {
        position: absolute;

        top: 50%;
        left: 50%;

        transform: translate(-50%, -50%);
        font-size: 50px;

        color: #fff;
        opacity: 0.9;

        pointer-events: none;

        transition: 0.3s ease;
    }

    .video-card:hover .play-icon {
        transform: translate(-50%, -50%) scale(1.15);
        opacity: 1;
    }

    /* Caption */

    .video-caption {
        margin-top: 10px;
        text-align: center;
    }


    /* ===========================
   MODAL VIDEO HEIGHT FIX
=========================== */

    #modalVideo {

        width: 100%;

        height: 500px;
        /* Absolute height */

        max-height: 75vh;
        /* Responsive fallback */

        object-fit: contain;

        background: #000;
    }


    /* Responsive tuning */

    @media (max-width: 768px) {

        #modalVideo {

            height: 300px;

        }

    }

    /* ===========================
   VIDEO CAPTION OVERLAY
=========================== */

    .video-caption-overlay {

        position: absolute;

        bottom: 0;
        left: 0;

        width: 100%;

        padding: 10px 8px;

        font-size: 13px;

        color: #fff;

        text-align: left;

        background: linear-gradient(to top,
                rgba(0, 0, 0, 0.85),
                rgba(0, 0, 0, 0.0));

        z-index: 2;

        pointer-events: none;
        text-align: center;

    }


    /* Optional hover enhancement */

    .video-card:hover .video-caption-overlay {

        background: linear-gradient(to top,
                rgba(0, 0, 0, 0.95),
                rgba(0, 0, 0, 0.1));

    }
</style>

</head>

<body>

    <?php include('assets/preloader.php'); ?>

    <header>
        <?php include('assets/nav.php'); ?>
    </header>

    <main>

        <!-- Hero Area -->
        <div class="slider-area slider-bg">
            <div class="single-slider d-flex align-items-center slider-height3">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8 col-lg-9 col-md-12">
                            <div class="hero__caption hero__caption3 text-center">
                                <h1>Gallery</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Gallery -->
        <section class="section-padding40">

            <div class="container">

                <div class="row">

                    <?php while ($video_gallery = mysqli_fetch_array($query)) { ?>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-4">

                            <div class="video-card video-thumb"
                                data-video="app/video-gallery/<?php echo $video_gallery['videoName']; ?>">

                                <?php

                                $thumb =
                                    "app/video-gallery/thumbnails/" .
                                    $video_gallery['posters'];

                                $video =
                                    "app/video-gallery/" .
                                    $video_gallery['videoName'];

                                if (
                                    !empty($video_gallery['posters'])
                                    && file_exists($thumb)
                                ) {

                                ?>

                                    <!-- Thumbnail -->

                                    <img
                                        src="<?php echo $thumb; ?>"
                                        alt="<?php echo $video_gallery['caption']; ?>"
                                        class="video-thumb-img">

                                <?php } else { ?>

                                    <!-- Video Preview Fallback -->

                                    <video
                                        class="video-preview-video"
                                        muted
                                        preload="metadata"
                                        playsinline>

                                        <source
                                            src="<?php echo $video; ?>#t=0.5"
                                            type="video/mp4">

                                    </video>

                                <?php } ?>


                                <!-- Play Icon -->

                                <div class="play-icon">
                                    ▶
                                </div>


                                <!-- Caption Overlay -->

                                <div class="video-caption-overlay">
                                    <?php echo $video_gallery['caption']; ?>
                                </div>

                            </div>

                            <div class="video-caption-overlay">
                                <?php echo $video_gallery['caption']; ?>
                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </section>

    </main>

    <!-- VIDEO MODAL -->

    <div class="modal fade" id="videoModal" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-body p-0">

                    <video
                        id="modalVideo"
                        class="w-100"
                        controls
                        playsinline
                        controlsList="nodownload">

                        <source id="modalSource" src="" type="video/mp4">

                    </video>

                </div>

            </div>

        </div>

    </div>

    <?php
    include('assets/footer.php');
    include('assets/includes/footscript.php');
    ?>

    <script>
        /* ===========================
   MODAL VIDEO CONTROL
=========================== */

        const modalElement =
            document.getElementById('videoModal');

        const modal =
            new bootstrap.Modal(modalElement);

        const modalVideo =
            document.getElementById('modalVideo');

        const modalSource =
            document.getElementById('modalSource');



        /* ===========================
           OPEN VIDEO
        =========================== */

        document
            .querySelectorAll('.video-thumb')
            .forEach(card => {

                card.addEventListener('click', function() {

                    const videoSrc =
                        this.getAttribute('data-video');

                    /* Load video */

                    modalSource.src = videoSrc;

                    modalVideo.load();

                    modal.show();

                    /* Auto-play safely */

                    setTimeout(() => {

                        modalVideo.play()
                            .catch(() => {});

                    }, 250);

                });

            });



        /* ===========================
           STOP VIDEO FUNCTION
        =========================== */

        function stopModalVideo() {

            if (!modalVideo) return;

            modalVideo.pause();

            modalVideo.currentTime = 0;

            /* Remove source completely */

            modalSource.src = "";

            modalVideo.load();

        }



        /* ===========================
           BOOTSTRAP 5 SUPPORT
        =========================== */

        modalElement.addEventListener(
            'hidden.bs.modal',
            stopModalVideo
        );



        /* ===========================
           BOOTSTRAP 4 SUPPORT
        =========================== */

        modalElement.addEventListener(
            'hide.bs.modal',
            stopModalVideo
        );



        /* ===========================
           EXTRA SAFETY:
           ESC + BACKDROP
        =========================== */

        document.addEventListener(
            'keydown',
            function(e) {

                if (e.key === "Escape") {

                    stopModalVideo();

                }

            });
    </script>

</body>

</html>