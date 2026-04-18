
<?php
include('../app/include/config.php');
$articleID = $_GET['article'];
echo $articleID; exit;
if (isset($_POST['subscribe'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
  
    $select_list = "SELECT * FROM newsletter WHERE name = '$name' AND email = '$email'";
// echo $select_list; exit;
    $list_query = mysqli_query($con, $select_list);
    $result = mysqli_fetch_array($list_query);
    if(!empty($result)){
        echo "<script>alert('Already Subscribed');
        window.history.back</script>";
    }else{
    $insert_list = "INSERT INTO newsletter VALUES(null, '$name', '$email', now())";
    $query = mysqli_query($con, $insert_list);
    if ($query) {
        echo "<script>alert('Subscribed Successfully');
        window.history.back</script>";
    }
}
}