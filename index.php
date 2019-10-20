<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div align="center">
		<form method="post">
			<input type="date" name="date" />
			<input type="submit" name="submit" />
		</form>
	</div>
</body>
</html>
<?php 
	if(isset($_POST['submit']))
	{
		$_SESSION['date'] = $_POST['date'];
	}
	if(isset($_SESSION['date']))
	{
		echo "Date selected is -".$_SESSION['date'];
	}
	
?>