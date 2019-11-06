<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Remote Logs</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row" style="margin-top: 50px;margin-bottom: 30px;">
				<div  style="text-align: center;" class="col-md-4"><button onclick="location.href='#alllogs'" class="btn btn-lg btn-primary">Students currently in class</button></div>
				<div style="text-align: center;"  class="col-md-4"><button onclick="location.reload()" class="btn btn-lg btn-warning">Refresh</button></div>
				<div style="text-align: center;"  class="col-md-4"><button onclick="location.href='#current'" class="btn btn-lg btn-primary">Recorded attendance</button></div>
			</div>
			<div class="row">
				<div id="current" class="col-md-12" style="margin-top: 15px;margin-bottom: 15px;">
					<h1 class="text-center text-primary">Students currently in class</h1>
				</div>
				<div class="col-md-12">
						<?php 
							$conn = mysqli_connect('localhost','root','','prashant');
							$sql = "select u.empid,u.name,u.rfid,r.access,date(r.scan_time),time(r.scan_time) from users as u inner join register as r on u.rfid=r.rfid where r.status=true";
							$result = mysqli_query($conn,$sql);
							if($result)
							{
								if(mysqli_num_rows($result)>0)
								{
									?>
									<table class="table table-striped">
										<tr>
											<th>Registration no.</th>
											<th>Student's Name</th>
											<th>Card Number</th>
											<th>Access</th>
											<th>In-Date</th>
											<th>in-Time</th>
										</tr>

									<?php
									while($row = mysqli_fetch_array($result))
									{
										?>
											<tr>
												<td><?php  echo $row[0]; ?></td>
												<td><?php  echo $row[1]; ?></td>
												<td><?php  echo $row[2]; ?></td>
												<td><?php  echo $row[3]; ?></td>
												<td><?php  echo $row[4]; ?></td>
												<td><?php  echo $row[5]; ?></td>
											</tr>
										<?php
									}
									?>
									</table>
									<?php
								}
								else
								{
									echo "<h3 class='text-center text-danger'>No student in class</h3>";
								}
							}
							else
							{
								echo mysqli_error($conn);
							}

						?>
				</div>
			</div>
			<div class="row">
				<div id="alllogs" class="col-md-12" style="margin-top: 15px;margin-bottom: 15px;">
					<h1 class="text-center text-primary">Recorded attendance</h1>
				</div>
				<div class="col-md-12">
						<?php 
							$conn = mysqli_connect('localhost','root','','prashant');
							$sql = "select u.empid,u.name,u.rfid,r.access,date(r.scan_time),time(r.scan_time),date(r.return_time),time(r.return_time),timediff(return_time,scan_time) as duration from users as u inner join register as r on u.rfid=r.rfid where r.return_time IS NOT NULL order by r.scan_time";
							$result = mysqli_query($conn,$sql);
							if($result)
							{
								if(mysqli_num_rows($result)>0)
								{
									?>
									<table class="table table-striped">
										<tr>
											<th>Registration No.</th>
											<th>Student's Name</th>
											<th>Card Number</th>
											<th>Access</th>
											<th>In-Date</th>
											<th>In-Time</th>
											<th>Out-Date</th>
											<th>Out-Time</th>
											<th>Duration</th>
										</tr>

									<?php
									while($row = mysqli_fetch_array($result))
									{
										?>
											<tr>
												<td><?php  echo $row[0]; ?></td>
												<td><?php  echo $row[1]; ?></td>
												<td><?php  echo $row[2]; ?></td>
												<td><?php  echo $row[3]; ?></td>
												<td><?php  echo $row[4]; ?></td>
												<td><?php  echo $row[5]; ?></td>
												<td><?php  echo $row[6]; ?></td>
												<td><?php  echo $row[7]; ?></td>
												<td><?php  echo $row[8]; ?></td>
											</tr>
										<?php
									}
									?>
									</table>
									<?php
								}
								else
								{
									echo "<h3 class='text-center text-warning'>No attendance history</h3>";
								}
							}
							else
							{
								echo mysqli_error($conn);
							}

						?>
				</div>
			</div>

			<div class="row">
				<div id="alllogs" class="col-md-12" style="margin-top: 15px;margin-bottom: 15px;">
					<h1 class="text-center text-primary">View specific date's log</h1>
				</div>
				<div align="center" class="col-md-12 text-center">
					Select Date : <input type="date" id="date"> <button id="submit" class="btn btn-primary">Submit</button>
				</div><br><br><br>
				<div id="col" class="col-md-12">
					
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#submit').click(function()
			{
				console.log($('#date').val());
				$.ajax({

					type : 'POST',
					url : 'fetch_new.php',
					data : {
						'date' : $('#date').val()
					},

					success : function(data1)
					{
						console.log("djfhj");
						$('#col').html(data1);
						console.log(data1);
					}

				});
			});
		});
		
	</script>
</html>
