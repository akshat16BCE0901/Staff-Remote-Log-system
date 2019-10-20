<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arun Kumar S attendance record</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

	<h2 class="text-center">
		LIST OF STUDENTS
	</h2>
	<br><br>
	<form method="post">
		<input type="date" name="date" />
		<input type="submit" name="submit" value="Submit">
	</form>
	<?php 
		if(isset($_POST['submit']))
		{
			$date = $_POST['date'];
			$_SESSION['date']= $date;
			echo ($_SESSION['date']);
		}
			echo ($_SESSION['date']);
		
	?>
	<div align="center" class="container">
		<div class="row">
			<table id="myTable" class="table table-striped table-hover" align="center" cellpadding="10px" border="1">
				<tr>
					<th>
						Student name
					</th>
					<th>
						RFID
					</th>
					<th>
						Registration number
					</th>
					<th>
						Status
					</th>
				</tr>
				<?php 
					$status = "";
					$conn = mysqli_connect("localhost","root","","rfid2") or die("Cannot connect");
					if($conn)
					{
						$query = "select * from `".$_SESSION['date']."`";
						$result = mysqli_query($conn,$query);
						if($result)
						{
							while ($row= mysqli_fetch_assoc($result)) 
							{
								echo '<tr>
										<td>
											'.$row["student"].'
										</td>
										<td>
											'.$row["card_no"].'
										</td>
										<td>
											'.$row["regno"].'
										</td>
										<td>
											'.$row["status"].'
										</td>
									</tr>';
							}
						}
						else
						{
							echo "fault".mysqli_error($conn);
						}
					}
				?>
			</table>
		</div>
	</div>
</body>
</html>
