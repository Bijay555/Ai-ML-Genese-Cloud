<?php 
	session_start();
	$db = mysqli_connect('database-1.cdmh2s57mnbt.us-east-1.rds.amazonaws.com', 'bjadmin', 'bj-admin', 'crud');

	/* check connection */
	if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$sql = "INSERT INTO info (name, address) VALUES ('$name', '$address')";
		mysqli_query($db,$sql); 
		$_SESSION['message'] = "Address saved"; 
		header('location: register.php');
	}
	if (isset($_POST['update'])) {
	$id = mysqli_real_escape_string($db, $_POST['id']);
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$address = mysqli_real_escape_string($db, $_POST['address']);

	mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: register.php');
}
	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM info WHERE id=$id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: register.php');
}

?>
