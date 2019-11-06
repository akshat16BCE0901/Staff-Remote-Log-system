<?php 
	$conn = mysqli_connect('localhost','root','','prashant');
	$date = $_POST['date'];
	$sql = "select u.empid,u.name,u.rfid,r.access,date(r.scan_time),time(r.scan_time),date(r.return_time),time(r.return_time),timediff(return_time,scan_time) as duration from users as u inner join register as r on u.rfid=r.rfid where r.return_time IS NOT NULL and date(r.scan_time)='$date' order by r.scan_time";
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
			echo "No records found";
		}
	}
	else
	{
		echo mysqli_error($conn);
	}

?>