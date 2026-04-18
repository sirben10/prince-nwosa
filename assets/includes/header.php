<?php
include('app/include/config.php');

// Book Lunching Event 
$lunchsql="select * from book_lunching ";
$query = mysqli_query($con, $lunchsql);
$lunchrows=mysqli_fetch_array($query);


// Latest Book
$booksql = mysqli_query($con, "select * from books order by bookID desc");
$bookrows=mysqli_fetch_array($booksql);


// About Author
$authorsql = mysqli_query($con, "select * from book_author");
$authorrows=mysqli_fetch_array($authorsql);


// All Books
$bookssql="select * from books ";
$bookquery = mysqli_query($con, $bookssql);


// All Articles
$articles_sql="select * from articles ";


// All Articles_photos
$articles_photos_sql="select * from article_photos ";

// Select free link
$select_link = "SELECT * FROM filelink ";


// Select Image Gallery
$select_images = "SELECT * FROM image_gallery ";


$title = "Prince N. Nwosa Ph.D, CIPMN";

include('assets/og-image.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Prince N. Nwosa Ph.D, CIPMN">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="assets/manifest.json">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.png">
    
    
    
<!--Meta-->
    <meta name="robots" content="all">
<meta name="viewport" content="width&#x3D;device-width,&#x20;initial-scale&#x3D;1,&#x20;minimum-scale&#x3D;1.0,&#x20;shrink-to-fit&#x3D;no">
<meta name="keywords" content="Author, Ph.D, Prince, Boston, Boston University, Bermingham, Salford, Manchester, University of Salfor, Manchester, Portharcourt, Publishers, Book, Speaker, Nigeria, African, Leaders, Oil, Gas, Oil & Gas, Oil and Gas, Lions,Lions International,Lions District 404A2 Nigeria,Lions District,Humanitarian,clubs, facebook
service,organization,world, community,District 404A2;
">
<meta name="description" content="Prince N. Nwosa Ph.D, CIPMN.">
<meta name="language" content="English">
<meta name="doc-type" content="Public">
<meta name="doc-class" content="Completed">
<meta name="doc-rights" content="Public">
<meta name="GOOGLEBOT" content="NOARCHIVE">
<meta name="Revisit-After" content="7 Days">
<meta name="robots" content="index,follow">
<meta name="GOOGLEBOT" content="index,follow">
<meta name="distribution" content="Global">
<meta name="rating" content="Safe For Kids">
<meta name="rating" content="general">
<meta name="author" content="Prince N. Nwosa Ph.D, CIPMN">
<meta http-equiv="X-UA-Compatible" content="IE edge,chrome 1">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="pragma" content="no-cache">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/animated-headline.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    
<meta name="google-site-verification" content="epbyYNBkUd_oKWgIZ9M8cNTYGa24yLvp9rQxORz8KVM" />

    