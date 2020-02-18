<?php

include ('connect.php');

$sql='SELECT * FROM users';
$query= mysqli_query($connect, $sql);

while($array = mysqli_fetch_array($query)){ 
	$row[]=$array;
}
?>

<table>
	<tr>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Address</td>
		<td>Email</td>
	</tr>
	<?php
	for ($i = 0; $i < count($row); $i++){
		?>
		<tr>
			<td><?php echo $row[$i]['first_name']; ?> </td>
			<td><?php echo $row[$i]['last_name']; ?> </td>
			<td><?php echo $row[$i]['address']; ?> </td>
			<td><?php echo $row[$i]['email']; ?> </td>
		</tr>
	<?php } ?>
</table>