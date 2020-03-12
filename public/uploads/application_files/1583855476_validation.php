<?php
session_start();

$con = mysqli_connect('localhost','admin','930421351136');

mysqli_select_db($con, 'db_comment');

$email = $_POST['email'];
$pass = $_POST['password'];

$s = "select * from comment_table where email = '$email' && password = '$pass'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
	$_SESSION['username'] = $email;
	header('location:index.php');
}else{
	header('location:login.php');	
}



 ?>