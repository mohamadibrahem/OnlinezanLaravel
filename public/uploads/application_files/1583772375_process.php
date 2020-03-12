<?php 
session_start();


include('include/db_connect.php');


if (isset($_POST['submit'])){
	$name = $_POST['name'];
	$comment = $_POST['comment'];

	$mysqli->query("INSERT INTO comment_table (name, comment) VALUES('$name', '$comment')") or die($mysqli->error);

	$_SESSION['message'] = "Коментарие было отправленно!";
	$_SESSION['msg_type'] = "success!";	

	header("Location: index.php");
}


if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM comment_table WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Коментарий был удален!";
	$_SESSION['msg_type'] = "danger!";	

	header("Location: admin.php");
}	



if (isset($_GET['ban'])){
	$id = $_GET['ban'];
	$mysqli->query("UPDATE comment_table SET visible = '0' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Коментарий запрещен!";
	$_SESSION['msg_type'] = "danger!";	

	header("Location: admin.php");
}


if (isset($_GET['permit'])){
	$id = $_GET['permit'];
	$mysqli->query("UPDATE comment_table SET visible = '1' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Коментарий разрешен!";
	$_SESSION['msg_type'] = "danger!";	

	header("Location: admin.php");
}

/**/





 ?>



