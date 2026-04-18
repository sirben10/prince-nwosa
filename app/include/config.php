<?php
define('DB_SERVER','localhost');
define('DB_USER','tkavosgf_princenwosa');
define('DB_PASS' ,'Prince.nwosa1');
define('DB_NAME', 'tkavosgf_princenwosa');


$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>