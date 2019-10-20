<?php
  session_start();
  $allow= $_GET['allow'];
  $id = $_GET['id'];
  $conn = mysqli_connect('localhost','root','','rfid2') or die('Cannot connect to the DB');
  $query ="insert into rfid_details values($id,$allow)";
  $result = mysqli_query($conn,$query);
  if($result)
  {
    echo "Stored in database";
  }
  else
  {
	  echo("Error".mysqli_error($conn));
  }
  
?>
