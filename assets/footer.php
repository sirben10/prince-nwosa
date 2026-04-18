<footer>
   <?php 
   if (!empty($_GET['book'])) {
    
    $bookURL = $_GET['book'];
    // echo  $bookURL; exit;
    $bookssql="select * from books WHERE bookURL = '$bookURL'";
    $bookquery = mysqli_query($con, $bookssql);
    $book = mysqli_fetch_array($bookquery);
   }else{
       $booksql="select * from books";
    $query = mysqli_query($con, $booksql);
   
   }
   
   ?>
    <!-- Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-5">
                <div class="modal-header mb-4">
                    <h3 class="modal-title" id="requestModalLabel">Request Free Book Pages</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="assets/free_pages_request.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group mb-5">
                                <input type="text" name="name" class="form-control p-5" placeholder='Your Name'
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Name'">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-5">
                                <input type="email" name="email" class="form-control p-5" placeholder='Your Email'
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email'">
                            </div>
                        </div>
                    <?php if(!empty($bookURL) && !empty($book)){?>
                        <div class="form-group">
                            <div class="input-group mb-5">
                                <input type="text" name="book_title" class="form-control p-5" value="<?php echo ucwords($book['bookTitle']) ?>" readonly>
                            </div>
                        </div>
                        <?php } else {?>
                        <div class="form-group">
                            <div class="input-group mb-5">
                                <select name="book_title" class="form-control">
                                    <?php
                                    
                                    while ($books = mysqli_fetch_array($query)) { ?>
                                        <option value="<?php echo ucwords($books['bookTitle']) ?>" class="p-5"><?php echo ucwords($books['bookTitle']) ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="request_pages" class="btn btn-primary">Submit</button>
                        <a data-dismiss="modal">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="footer-wrappr" data-background="assets/img/gallery/footer-bg.png">
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="single-footer-caption mb-50 justify-content-center">
                    <!-- logo -->
                    <div class="footer-logo mb-25">
                        <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                    </div>
                    <div class="footer-tittle mb-50 ">
                        <p>Speaker, Motivator, Scholar & Writer</p>
                    </div>

                    <div class="footer-social mt-50 text-center">
                        <a class="mr-5" target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="mr-5" target="_blank" href="https://www.facebook.com/profile.php?id=61575865199067"><i class="fab fa-facebook-f"></i></a>
                        <a class="mr-5" target="_blank" href="https://www.youtube.com/@PrinceNwosa"><i class="fab fa-youtube"></i></a>
                        <a class="mr-5" target="_blank" href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
                <div class="align-items-center justify-content-center d-block">
                    <!-- Main-menu -->
                    <div class="foot-nav">
                        <nav>
                            <ul>
                                <li><a href="inde">Home</a></li>
                                <li><a href="about_author">About</a></li>
                                <li><a href="books">Books</a></li>
                                <li><a href="articles">Articles</a> </li>
                                <li><a href="contact">Contact</a></li>
                                <!-- Button -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="footer-copy-right text-center">
                                <p>
                                    &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> Prince N. Nwosa. All rights reserved | Designed by <a href="#" target="_blank">Benaki Concepts</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</footer>