<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Users</title>
	<link rel="stylesheet" type="text/css" href="jstyle.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div id="header">
		<h1>Users Data</h1>
	</div>
	<script>
		$(document).ready(function(){
			getData();
			function getData (){
				$.ajax({
					type: 'POST',
					url: 'jselect.php',
					data: {'select_key': 1},
					dataType: "JSON",
					success: function(data) {
						var htmlData = '';
						for (var i = 0; i < data.arr.length; i++) {

							htmlData = htmlData + '<tr> <td class = "firstname">'+
							data.arr[i].first_name +'</td>\
								<td class = "lastname">' + data.arr[i].last_name + '</td>\
								<td class = "address">' + data.arr[i].address + '</td>\
								<td class = "email">' + data.arr[i].email + '</td>\
								<td><input type = "radio" name="update"/> </td>\
								<td><input type = "radio" name="delete"/> </td>\
								<input type = "hidden" class = "row_id" value = ' + data.arr[i].id + '>\
								 </tr>';

						}
						$('#person_table').html(htmlData);
					}
				});
			}
			$('#send').on('click', function(){
				var firstname = $('#frst').val();
				var lastname = $('#lst').val();
				var address = $('#ad').val();
				var email = $('#em').val();
				$.ajax({
					type: 'POST',
					url: 'jinsert.php',
					data: {'frst': firstname, 'lst': lastname, 'ad': address, 'em': email, 'ins': 1},
					success: function(data)  {
						var answer = $(data).filter('#ans').text();
						alert(answer);
						getData();
						$('#frst').val('');
						$('#lst').val('');
						$('#ad').val('');
						$('#em').val('');
					}
				});

			});
			$(document).on('click','input[name="update"]',function(){
			var firstname = $(this).parent().siblings(".firstname").text();
			var lastname = $(this).parent().siblings(".lastname").text();
			var address = $(this).parent().siblings(".address").text();
			var email = $(this).parent().siblings(".email").text();
			var id = $(this).parent().siblings(".row_id").val();

			var data = '<input type = "text" class="nm" value = ' + firstname +'>\
				<input type="text" class = "srnm" value = ' + lastname + '>\
				<input type="text" class = "ad" value = ' + address + '>\
				<input type="text" class = "em" value = ' + email + '>\
				<input type="hidden" class = "row_id" value = ' + id + '>\
				<input type="button" class = "upd" value = "change">';

				$('#edit').html(data);
			});

		$(document).on('click','.upd', function(){ 
			var nameVal = $(this).siblings('.nm').val();
			var surnameVal = $(this).siblings('.srnm').val();
			var addressVal = $(this).siblings('.ad').val();
			var emailVal = $(this).siblings('.em').val();
			var id = $(this).siblings('.row_id').val();

			$.ajax ({
				type:"POST",
				url:"jinsert.php",
				data:{"frst":nameVal, "lst":surnameVal, "ad":addressVal, "em":emailVal, 
				"ident":id, "update_key":3},
				success:function(data){
					$("#edit").hide();
					var answer= $(data).filter('#ans').text();
					alert(answer);
					getData();
				}
			})

		})
		$(document).on('click','input[name="delete"]',function(){
			var id = $(this).parent().siblings(".row_id").val();

				var confDel = confirm('Are you sure to delete?');
				if(confDel == true){
					$.ajax({
						type: "POST",
						url: "jinsert.php",
						data: {"ident":id, "delete_key":3},
						success:function(data){
							var answer = $(data).filter('#ans').text();
							alert(answer);
							getData();
				}
			})

		}		
	}) 

	});
		
			
	</script>
	
	<form>
		<div id="register">
		<label>Firstname</label>
		<input type="text" name="firstname" id='frst'>
		<label>Lastname</label>
		<input type="text" name="lastname" id='lst'>
		<label>Address</label>
		<input type="text" name="address" id='ad'>
		<label>Email</label>
		<input type="text" name="email" id='em'>
		<input type="button" id='send' name="put" value="send">
		</div>
	</form>
	
	
	<table>
		<thead>
				<tr>
					<div class="list">
					<th class="firstname"> First Name</th>
					<th class="lastname"> Last Name</th>
					<th class="address"> Address</th>
					<th class="email"> Email</th>
					<th>update</th>
					<th>delete</th>
					</div>
				</tr>
			<tbody id="person_table"></tbody>
		</thead>
	</table>
	<div id='edit'></div>
</body>
</html>