
<?php 

include('assets/includes/header.php');

$linkID = $_GET['id'];
// echo $linkID; exit;
date_default_timezone_set("Africa/Lagos");
$now = date('Y-m-d H:i:s');
$select_link = "SELECT bookID from filelink WHERE random_string = '$linkID' AND expiry > '$now'";
// echo $select_link; exit;
$linkquery = mysqli_query($con, $select_link);
if($link = mysqli_fetch_array($linkquery)){
    $bookLinkID = $link['bookID'];

    $select_path = "SELECT * from books WHERE bookID = ".$bookLinkID;
  $pathquery = mysqli_query($con, $select_path);
  if($path = mysqli_fetch_array($pathquery)){
    // echo $path['phyical_path']; exit;
    $physical_path = $path['phyical_path'];
    $file = $physical_path.$path['freeBook'];
    echo "<script> window.location.replace('$file');</script>"; exit;
    // header("location: $file"); exit;
}
}
else {
    header('HTTP/1.0 404 Not Found');
    echo '404 Not Found';
}



?>


