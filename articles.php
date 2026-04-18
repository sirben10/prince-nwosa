<?php include('assets/includes/header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$other_article = $articles_sql;
$other_article .= "Order by Rand() LIMIT 4";

if (!empty($_GET['article'])) {
  $articleID = $_GET['article'];


  // SEND FREE PAGES REQUEST EMAIL

  $articles_sql .= "WHERE articleID = $articleID";
  $articles_query = mysqli_query($con, $articles_sql);
  $articles_row = mysqli_fetch_array($articles_query);
  // echo $articles_row['articleTitle']; exit;

} else {

          if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
          } else {
            $pageno = 1;
          }
          $no_of_records_per_page = 2;
          $offset = ($pageno - 1) * $no_of_records_per_page;

          $total_pages_sql = "SELECT COUNT(*) FROM articles";
        $result = mysqli_query($con, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


   $articles_sql .="ORDER by articleID  DESC LIMIT $offset, $no_of_records_per_page";       
  $articles_query = mysqli_query($con, $articles_sql);
}
// if (isset($_POST['request_pages'])) {
//   // $to = "author@princenwosa.com";
//   $name = htmlspecialchars(strip_tags(stripslashes($_POST['name'])));
//   $from = htmlspecialchars(strip_tags(stripslashes($_POST['email'])));
//   $book_title = htmlspecialchars(strip_tags(stripslashes($_POST['book_title'])));
//   $random_string = bin2hex(random_bytes(16));
//   $expire = date('Y-m-d H:i:s', strtotime('+60 minutes'));

//   $newbooksql = "SELECT DISTINCT(bookID)  FROM books Where bookTitle = '$book_title'";
//   $newbookquery = mysqli_query($con, $newbooksql);
//   if ($result = mysqli_fetch_array($newbookquery)) {
//     $bookID = $result['bookID'];
//     $link_sql = "INSERT into filelink values(null,$bookID, '$random_string','$expire')";
//     $link_result = mysqli_query($con, $link_sql);
//     if ($link_result) {
//       $filelink =  $_SERVER['DOCUMENT_ROOT'] . "/book_download?id=" . $random_string;
//       // echo $filelink; exit;
//     }
//   }

//   // echo $filelink; exit;

//   require 'vendor/autoload.php';
//   $mail = new PHPMailer(true);

//   try {
//     $mail->SMTPDebug = 0;
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'mail.princenwosa.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'author@princenwosa.com';                     //SMTP username
//     $mail->Password   = 'Prince.nwosa1';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom($from, $name);
//     $mail->addAddress('author@princenwosa.com');


//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Free Book Page Request';
//     $mail->Body    = '<html><body>
// 					<table style="width: 100%;">
// 						<thead style="text-align: center;"><tr><td style="border:none;" colspan="2"> 
// 						</td></tr></thead>
// 						<tbody>
// 							<tr><b> Free Bok Pages Request </b></tr><<br>
// 								<tr><td style="border:none;"><strong>Name:</strong> ' . $name . '</td> 
//                 </tr><br>
// 								<tr><td style="border:none;"><strong>Email:</strong> ' . $from . '</td></tr>
// 							<tr><td style="border:none;"><strong>Book Title</strong> ' . $book_title . '</td></tr>
// 						</tbody>
// 					</table>
// 					</html> </body>

// 						';
//   } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }


//   $copymail = new PHPMailer(true);

//   try {
//     //Server settings
//     $copymail->SMTPDebug = 0;
//     $copymail->isSMTP();
//     $copymail->Host       = 'mail.princenwosa.com';
//     $copymail->SMTPAuth   = true;
//     $copymail->Username   = 'author@princenwosa.com';                     //SMTP username
//     $copymail->Password   = 'Prince.nwosa1';
//     $copymail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//     $copymail->Port       = 465;
//     $copymail->setFrom('author@princenwosa.com', 'Dr Price N. Nwosa');
//     $copymail->addAddress($from);
//     $copymail->isHTML(true);                                  //Set ecopymail format to HTML
//     $copymail->Subject = 'Free Book Pages Request Received';
//     $copymail->Body    = '<html>
// <body>
// <table style="border-collapse:collapse;max-width:300px; ">
// <tbody>
//   <tbody>
//             <tr>
//                 <td><b>Free Book Pages Request Received for ' . $book_title . '</b><br>
//                     <br>
//                    <br>
//                      <p style="font-weight: bold;">Here is your download Link </p>
    
//                     <hr style="border:0;border-bottom:1px solid #e9e9e9">
    
//                     <p><a href="' . $filelink . '" style="color: #fff; text-decoration:none; background-color: #ff3500; padding: 10px;">Download free Pages</a></p> <br>
                   
//                     <br>
//                     <strong>Note: Link Expires in 30 minutes</strong>
//                 </td>
//             </tr>
//       </tbody>
// </table>
// </body>
// </html>';
//   } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$copymail->ErrorInfo}";
//   }


//   echo "<script>alert('Request Sent Successfully');
// window.history.back</script>";
//   $mail->send();
//   $copymail->send();
// }

if (isset($_POST['subscribe'])) {
  require 'vendor/autoload.php';
  $name = htmlspecialchars(strip_tags(stripslashes($_POST['name'])));
  $email = htmlspecialchars(strip_tags(stripslashes($_POST['email'])));

  $newsmail = new PHPMailer(true);

  try {
    $newsmail->SMTPDebug = 0;
    $newsmail->isSMTP();                                            //Send using SMTP
    $newsmail->Host       = 'mail.princenwosa.com';                     //Set the SMTP server to send through
    $newsmail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $newsmail->Username   = 'author@princenwosa.com';                     //SMTP username
    $newsmail->Password   = 'Prince.nwosa1';                               //SMTP password
    $newsmail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $newsmail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $newsmail->setFrom('notification@princenwosa.com');
    $newsmail->addAddress('author@princenwosa.com');


    //Content
    $newsmail->isHTML(true);                                  //Set email format to HTML
    $newsmail->Subject = 'New Subscriber';
    $newsmail->Body    = '<html><body>
					<table style="width: 100%;">
						<thead style="text-align: center;"><tr><td style="border:none;" colspan="2"> 
						</td></tr></thead>
						<tbody>
							<tr><b>A user Just Subscribed, see details below</b></tr><br><br>
								<tr><td style="border:none;"><strong>Name:</strong> ' . $name . '</td> <br>
                </tr>
								<tr><td style="border:none;"><strong>Email:</strong> ' . $email . '</td></tr>
						</tbody>
					</table>
					</html> </body>

						';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$newsmail->ErrorInfo}";
  }

  $select_list = "SELECT * FROM newsletter WHERE name = '$name' AND email = '$email'";
  // echo $select_list; exit;
  $list_query = mysqli_query($con, $select_list);
  $result = mysqli_fetch_array($list_query);
  if (!empty($result)) {
    echo "<script>alert('Already Subscribed');
      window.history.back</script>";
  } else {
    $insert_list = "INSERT INTO newsletter VALUES(null, '$name', '$email', now())";
    $query = mysqli_query($con, $insert_list);
    if ($query) {
      echo "<script>alert('Subscribed Successfully');
      window.history.back</script>";
      $newsmail->send();
    }
  }
}




?>
<title> Articles | Dr. Prince Nwosa - Speaker, Motivator, Scholar & Writer.</title>

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
  <main>
    <!-- Slider Area Start-->
    <div class="slider-area slider-bg ">
      <!-- Single Slider -->
      <div class="single-slider d-flex align-items-center slider-height3">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-xl-8 col-lg-9 col-md-12 ">
              <div class="hero__caption hero__caption3 text-center">
                <h1 data-animation="fadeInLeft" data-delay=".6s "><?php if (!empty($articleID)) {
                                                                    // echo $articleID; exit;
                                                                    echo ucwords($articles_row['articleTitle']);
                                                                  } else {
                                                                    echo 'Articles';
                                                                  }  ?></h1>
                <h3><span data-animation="fadeInLeft" data-delay=".6s "><?php if (!empty($articleID)) {
                                                                          echo date('d-m-Y', strtotime($articles_row['dateUpdated']));
                                                                        } else {
                                                                          echo 'Dr. Prince N. Nwosa';
                                                                        } ?></span></h3>
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
    <!-- Hero Area End-->
    <!--? Blog Area Start-->
    <section class="blog_area section-padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="blog_left_sidebar">
              <?php if (!empty($articleID)) { ?>
                <article class="blog_item">
                  <div class="blog_item_img">
                    <img class=" rounded-0 img-fluid" src="app/articlePhotos/<?php echo $articles_row['previewPhoto']; ?>" alt="">

                  </div>
                  <div class="blog_details">
                    <a class="d-inline-block">
                      <h2 class="blog-head" style="color: #2d2d2d;"><?php echo ucwords($articles_row['articleTitle']); ?></h2>
                    </a>

                    <ul class="blog-info-link">
                      <li><a href="#"><i class="fa fa-calendar"></i> </i> <?php echo date('d-m-Y', strtotime($articles_row['dateUpdated'])); ?></a></li>
                      <!-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> -->
                    </ul>
                    <p class="text-justify"> <?php echo $articles_row['articleDesc']; ?></p>
                    <div class="row">

                      <?php
                      $articles_photos_sql .= "WHERE articleID = $articleID";

                      // echo $articles_photos_sql; exit;
                      $articles_photos_query = mysqli_query($con, $articles_photos_sql);
                      while ($articles_photos_row = mysqli_fetch_array($articles_photos_query)) { ?>

                        <div class="col-4 mb-4">
                          <img style="height: 150px; width: auto;" class="img-fluid" src="app/articlePhotos/<?php echo $articles_photos_row['photoName'] ?>" alt="">
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </article>
                <?php } else {
                while ($articlesss = mysqli_fetch_array($articles_query)) { ?>
                  <article class="blog_item">
                    <div class="blog_item_img">
                      <img style="height: 500px !important; width: 100% !important;" class="card-img rounded-0" src="app/articlePhotos/<?php echo $articlesss['previewPhoto']; ?>" alt="">

                    </div>
                    <div class="blog_details">
                      <a class="d-inline-block" href="articles?article=<?php echo $articlesss['articleID']; ?>">
                        <h2 class="blog-head" style="color: #2d2d2d;"><?php echo ucwords($articlesss['articleTitle']); ?></h2>
                      </a>

                      <ul class="blog-info-link">
                        <li><a href="#"><i class="fa fa-calendar"></i> </i> <?php echo date('d-m-Y', strtotime($articlesss['dateUpdated'])); ?></a></li>
                        <!-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> -->
                      </ul>
                      <p class="text-justify"> <?php echo substr($articlesss['articleDesc'], 0, strpos($articlesss['articleDesc'], ' ', 350)); ?>... <a class="d-block" href="articles?article=<?php echo $articlesss['articleID']; ?>">Read more <i class="fa fa-arrow-right"></i> </a></p>
                     
                                           
                    </div>

                  </article>
                <?php } ?>


                <nav class="blog-pagination justify-content-center d-flex">
                  <ul class="pagination">
                    <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                    <li class="<?php if ($pageno <= 1) {
                                  echo 'disabled';
                                } ?> page-item">
                      <a href="<?php if ($pageno <= 1) {
                                  echo '#';
                                } else {
                                  echo "?pageno=".($pageno - 1);
                                } ?>" class="page-link">
                        <i class="ti-angle-left"></i>
                      </a>
                    </li>
                    <li class="<?php if ($pageno >= $total_pages) {
                                  echo 'disabled';
                                } ?> page-item">
                      <a href="<?php if ($pageno >= $total_pages) {
                                  echo '#';
                                } else {
                                  echo "?pageno=". ($pageno + 1);
                                } ?> " class="page-link">
                                 <i class="ti-angle-right"></i>
                                </a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                  
                  </ul>
                </nav>
              <?php } ?>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="blog_right_sidebar">
              <aside class="single_sidebar_widget search_widget">
                <div class="my-5">
                  <h1 class="text-center">Request Free Pages</h1>
                </div>

                <form action="assets/free_pages_request.php" method="post">
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="text" name="name" class="form-control" placeholder='Your Name'
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Name'">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group mb-3">
                      <input type="email" name="email" class="form-control" placeholder='Your Email'
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email'">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <select name="book_title" class="form-control">
                        <?php
                        while ($books = mysqli_fetch_array($bookquery)) { ?>
                          <option value="<?php echo $books['bookTitle'] ?>"><img class="img-fluid" src="app/bookCover/<?php echo $books['bookCover'] ?>"><?php echo $books['bookTitle'] ?></option>
                        <?php } ?>
                      </select>

                    </div>
                  </div>
                  <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                    type="submit" name="request_pages">Submit</button>
                </form>
              </aside>
              <aside class="single_sidebar_widget popular_post_widget">
                <h3 class="widget_title" style="color: #2d2d2d;">Other Articles</h3>

                <div class="row">
                  <?php
                  $articles = mysqli_query($con, $other_article);
                  while ($articlesrows = mysqli_fetch_array($articles)) { ?>
                    <div class="col-12 mb-5">

                      <div class="media post_item">
                        <img style="height: 50px !important; width: 30%;" class="img-fluid" src="app/articlePhotos/<?php echo $articlesrows['previewPhoto']; ?>" alt="">
                        <div class="media-body">
                          <a href="articles_details?article=<?php echo $articlesrows['articleID']; ?>">
                            <h3 style="color: #2d2d2d;" title="<?php echo $articlesrows['articleTitle']; ?>"> <?php echo ucwords(substr(strip_tags(stripcslashes($articlesrows['articleTitle'])), 0, 20)); ?>...</h3>
                          </a>
                          <p><?php echo date('D', strtotime($articlesrows['dateUpdated'])) . ' ,' . date('d-m-Y', strtotime($articlesrows['dateUpdated'])); ?></p>
                        </div>
                      </div>

                    </div>
                  <?php } ?>
                </div>
              </aside>
              <aside class="single_sidebar_widget newsletter_widget">
                <h4 class="widget_title" style="color: #2d2d2d;">Sign Up For My Mailing List</h4>
                <form action="" method="post">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Enter name'" placeholder='Enter name' required>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" class="form-control" onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                  </div>
                  <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" name="subscribe" type="submit">Subscribe</button>
                </form>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Blog Area End -->
  </main>
  <?php
  include('assets/footer.php');
  include('assets/includes/footscript.php')
  ?>

</body>

</html>