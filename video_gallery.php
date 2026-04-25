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
    padding-top: 100%; /* 1:1 square */
    overflow: hidden;
    border-radius: 10px;
    background: #000;
    cursor: pointer;
}

/* === THUMBNAIL IMAGE === */
.video-thumb-img {
    position: absolute;
    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    object-fit: cover; /* Makes thumbnail responsive */
}

/* === PLAY ICON === */
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

/* Hover effect */
.video-card:hover .play-icon {
    transform: translate(-50%, -50%) scale(1.15);
    opacity: 1;
}

/* Caption */
.video-caption {
    margin-top: 10px;
    text-align: center;
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

        <!-- Thumbnail Image -->
        <img 
            src="app/video-gallery/thumbnails/<?php echo $video_gallery['posters']; ?>" 
            alt="<?php echo $video_gallery['caption']; ?>"
            class="video-thumb-img"
        >

        <!-- Play Icon -->
        <div class="play-icon">
            ▶
        </div>

    </div>

    <div class="video-caption">
        <p><?php echo $video_gallery['caption']; ?></p>
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

<video id="modalVideo" class="w-100" controls>

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

/* === MODAL VIDEO SCRIPT === */

const modal = new bootstrap.Modal(
    document.getElementById('videoModal')
);

const modalVideo = document.getElementById('modalVideo');
const modalSource = document.getElementById('modalSource');

/* Click to open video */

document.querySelectorAll('.video-thumb')
.forEach(card => {

card.addEventListener('click', function () {

    const videoSrc = this.getAttribute('data-video');

    modalSource.src = videoSrc;

    modalVideo.load();

    modal.show();

});

});

/* Stop video when modal is closed */

const videoModal = document.getElementById('videoModal');

// Handle both Bootstrap 4 and 5 events
videoModal.addEventListener('hidden.bs.modal', function () {
    stopVideo();
});

videoModal.addEventListener('hidden', function () {
    stopVideo();
});

function stopVideo() {
    modalVideo.pause();
    modalVideo.currentTime = 0;
    modalSource.src = "";
    modalVideo.load();
}

</script>

</body>

</html>