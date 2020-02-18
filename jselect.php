<?php

include ('connect.php');

if(isset($_POST['select_key'])) {
	$sql='SELECT * FROM users';
	$query= mysqli_query($connect, $sql);

	while($array = mysqli_fetch_array($query)){ 
		$row[]=$array;
	}
	$ar = array("arr" => $row);
	$json_array = json_encode($ar);
	print_r($json_array);
}

?>

