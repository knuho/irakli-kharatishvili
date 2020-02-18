<?php

include ('connect.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$lastname = $_POST['address'];
$lastname = $_POST['email'];

$sql="INSERT INTO users(first_name, last_name, address, email) VALUES (?,?,?,?)";

$prepare_query = mysqli_prepare($connect, $sql);

mysqli_stmt_bind_param($prepare_query, 'ss', $firstname, $lastname, $address, $email);

$execute =  mysqli_stmt_execute($prepare_query);

if($execute){
	echo 'ok';
}else{
	echo 'error';
}
?>