<?php

	$conn = mysqli_connect('localhost','root','','prashant');
	$allow = $_GET['allow'];
	$id = $_GET['id'];
	echo $allow;
	echo $id;
	$access = "Unauthorized";
	if($allow==1)
	{
		$access = "Authorized";
	}

	$sql2 = "select * from register where rfid='$id' and status=true";
	$result2 = mysqli_query($conn,$sql2);
	if($result2)
	{
		if(mysqli_num_rows($result2)>0)
		{
			$sql3 = "UPDATE register set status=false,return_time=current_timestamp where rfid='$id' and status=true";
			mysqli_query($conn,$sql3);
		}
		else
		{
			$sql = "INSERT into `register`(`rfid`,`access`,`status`) VALUES('$id','$access',true)";
			mysqli_query($conn,$sql);
		}
	}



?>