<!DOCTYPE html>
<html>
<head>
	<title>Attendance record</title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="4" />
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
	<div align="center" class="container">
		<div class="row">
			<table id="myTable" class="table table-striped table-hover" align="center" cellpadding="10px" border="1">
				<tr>
					<th>
						RFID
					</th>
					<th>
						Student name
					</th>
					<th>
						Status
					</th>
				</tr>
				<?php
					$conn = mysqli_connect("localhost","root","","rfid2") or die("Cannot connect");
					if($conn)
					{
						$query = "select * from `rfid_details` inner join `students` on rfid_details.card_name = students.card";
						$result = mysqli_query($conn,$query);
						if($result)
						{
							
							while ($row= mysqli_fetch_assoc($result)) 
							{
								echo "<tr>
										<th>
											".$row['card_name']."
										</th>
										<th>
											".$row['student']."
										</th>
										<th>
											";
											if($row['allow']==1)
											{
												echo "Valid";
											}
											else{
												echo "Invalid";
											}
											echo"
										</th>
									</tr>"; 
							}
						}
						else
						{
							echo mysqli_error($conn);
						}
					}
				?>
			</table>
		</div>
	</div>
	
</body>
</html>