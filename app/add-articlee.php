<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    $postID = intval($_GET['pid']);
    $session = $_SESSION['login'];
    $select = "SELECT userID  From tblusers WHERE loginID = '$session'";
    $sth = $con->query($select);
    $result = mysqli_fetch_array($sth);
    $addedBy = $result['userID'];


    // For adding post  
    $posttitle = strtolower($_POST['posttitle']);
    $catid = $_POST['category'];
    $subcatid = $_POST['subcategory'];
    $postdetails = str_replace(array( '\'', '"',
    ';','*' ), ' ', $_POST['postdescription']);
    $arr = explode(" ", $posttitle);
    $url = implode("-", $arr);
    $imgfile = strtolower($_FILES["postimage"]["name"]);
    // echo $imgfile; exit;

    if (isset($_POST['submit'])) {

        // get the image extension
        $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            //rename the image file
            $imgnewfile = md5($imgfile) . $extension;
            // Code for move image into directory
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

            $status = 1;
            $sql = "INSERT INTO tblpost VALUES(NULL,  $subcatid, '$posttitle', '$postdetails', '$url', '$imgnewfile', NOW(), $addedBy, $status)";
            // echo $sql; exit;
            $query = mysqli_query($con, $sql);
            if ($query) {
                $msg = "Post successfully added ";
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }
    }
    // UPDATE POST

    if (isset($_POST['update'])) {

        if ($imgfile) {
            // get the image extension
            $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
            // allowed extensions
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
            // Validation for allowed extensions .in_array() function searches an array for a specific value.
            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } else {
                //rename the image file
                $imgnewfile = md5($imgfile) . $extension;
                // Code for move image into directory
            }}
                move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

            $status = 1;
            $update = "UPDATE tblpost SET postCatID = $subcatid, postTitle = '$posttitle', postDetails = '$postdetails', postURL = '$url', postUpdated = NOW(), updatedBy = $addedBy";
            // echo $sql; exit;
            if ($imgfile) {
                $update .= ", postPhoto = '$imgnewfile' ";
            }
            $update .= " WHERE postID = $postID";
            $query = mysqli_query($con, $update);
            if ($query) {
                $msg = "Post successfully Updated ";
            } else {
                $error = "Something went wrong . Please try again.";
            }
        }
    
    ?>
    <?php include('includes/pages-head.php'); ?>
    <!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <title>Leo District 404A2 -- Official Website | Add Post</title>


    <script>
        function getSubCat(val) {
            $.ajax({
                type: "POST",
                url: "get_subcategory.php",
                data: 'catid=' + val,
                success: function (data) {
                    $("#subcategory").html(data);
                }
            });
        }
    </script>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('includes/topheader.php'); ?>
            <!-- ========== Left Sidebar Start ========== -->
            <?php include('includes/leftsidebar.php'); 
            include('includes/config.php');?>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Post </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Add Post </a>
                                        </li>
                                        <li class="active">
                                            Add Post
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <!---Success Message--->
                            <?php if ($msg) { ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong>
                                <?php echo htmlentities($msg); ?>
                            </div>
                            <?php } ?>

                            <!---Error Message--->
                            <?php if ($error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong>
                                <?php echo htmlentities($error); ?>
                            </div>
                            <?php } ?>


                        </div>
                    </div>

                    <?php
                     $select = "SELECT * from tblpost p join tblsubcategory s on s.subCatID=p.postCatID 
                     inner join tblcategory c on c.postCatID =s.categoryID  where p.isActive=1 and postID =$postID";
                     // echo $select; exit;
                     $query = mysqli_query($con, $select);
                     $rows = mysqli_fetch_assoc($query)
                    ?>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="p-6">
                                <div class="">
                                    <form name="addpost" method="post" enctype="multipart/form-data">
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Post Title</label>
                                            <input type="text" class="form-control" id="posttitle" value="<?php if ($postID || $result) {
                                               echo $rows['postTitle'];
                                            }?>" name="posttitle"
                                                placeholder="Enter title" required maxlength="60">
                                        </div>



                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select class="form-control" name="category" id="category"
                                                onChange="getSubCat(this.value);" required>
                                                <option value="<?php if ($postID || $result) {
                                               echo $rows['postCatID'];
                                            } else { echo ''; }?>"><?php if ($postID || $result) {
                                                echo $rows['postCategory']; }else { echo 'Select Category'; }?> </option>
                                                <?php
                                                // Feching active categories
                                                $ret = mysqli_query($con, "select * from  tblcategory where isActive=1");
                                                while ($result = mysqli_fetch_array($ret)) {
                                                    ?>
                                                <option value="<?php echo htmlentities($result['postCatID']); ?>">
                                                    <?php echo htmlentities($result['postCategory']); ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Sub Category</label>
                                            
                                            <select class="form-control" name="subcategory" id="subcategory" required>
                                            <option value="<?php if ($postID || $result) {
                                               echo $rows['postCatID'];
                                            } else { echo ''; }?>"><?php if ($postID || $result) {
                                                echo $rows['subcategory']; }else { echo 'Select Category'; }?> </option>
                                            </select>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Post Details</b></h4>
                                                    <textarea class="summernote" name="postdescription"
                                                        required><?php if ($postID || $result) {
                                               echo $rows['postDetails'];} ?></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Feature Image</b></h4>
                                                    <input type="file" class="form-control" id="postimage"
                                                        name="postimage" <?php if ($postID == ''){?> required <?php }?> >
                                                </div>
                                            </div>
                                        </div>


                                        <button type="submit" name="<?php if ($postID || $result) {
                                               echo 'update';
                                            } else { echo 'submit'; }?>"
                                            class="btn btn-success waves-effect waves-light"><?php if ($postID || $result) {
                                               echo 'Update';
                                            } else { echo 'Save and Post'; }?></button>
                                        <a type="reset"
                                            class="btn btn-danger waves-effect waves-light" href="manage-posts">Cancel</a>
                                    </form>
                                </div>
                            </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

                <?php include('includes/footer.php'); ?>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
        <!-- Select 2 -->
        <script src="../plugins/select2/js/select2.min.js"></script>
        <!-- Jquery filer js -->
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

        <!-- page specific js -->
        <script src="assets/pages/jquery.blog-add.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function () {

                $('.summernote').summernote({
                    height: 240, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <!-- <script src="../plugins/summernote/summernote.min.js"></script> -->




    </body>

    </html>
<?php } ?>