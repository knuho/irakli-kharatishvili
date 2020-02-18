<?php

include ('connect.php');

if(isset($_POST['ins'])) {

	$firstname = $_POST['frst'];
	$lastname = $_POST['lst'];
	$address = $_POST['ad'];
	$email = $_POST['em'];


	
	$sql = "INSERT INTO users(first_name, last_name, address, email) VALUES (?,?,?,?)";
	$prepare_query = mysqli_prepare($connect, $sql);

	mysqli_stmt_bind_param($prepare_query, 'ssss', $firstname, $lastname, $address, $email);

	$execute =  mysqli_stmt_execute($prepare_query);

	if($execute){
		echo '<div id="ans">ok</div>';
	}else{
		echo '<div id="ans">error</div>';
	}
}elseif (isset($_POST['update_key'])) {
	$id = $_POST['ident'];
	$firstname = $_POST['frst'];
	$lastname = $_POST['lst'];
	$address = $_POST['ad'];
	$email = $_POST['em'];

	$sql = 'UPDATE users SET first_name=?, last_name=?, address=?, email=? WHERE id=?';
	$prepare_query = mysqli_prepare($connect, $sql);

	$query = mysqli_query($connect, $sql);
	mysqli_stmt_bind_param($prepare_query,'ssssi', $firstname, $lastname, $address, $email, $id);

	$execute = mysqli_stmt_execute($prepare_query);

	if($execute){
		echo '<div id="ans">ok</div>';
	}else{
		echo '<div id="ans">error</div>';
	}


}elseif(isset($_POST['delete_key'])) {
	$id = $_POST['ident'];

	$sql = 'DELETE FROM users WHERE id=?';
	$prepare_query = mysqli_prepare($connect, $sql);

	$query = mysqli_query($connect, $sql);
	mysqli_stmt_bind_param($prepare_query, 'i', $id);

	$execute = mysqli_stmt_execute($prepare_query);

	if($execute){
		echo '<div id="ans">ok</div>';
	}else{
		echo '<div id="ans">error</div>';
	}
}

?>