<?php
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
    $email = $_POST['email'];
	$number = $_POST['number'];
    $gender = $_POST['gender'];
	$password = $_POST['password'];

	// Database connection
	$conn = new mysqli('localhost','root','ROOT','tproject');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into registration(firstName, lastName, email, number, gender, password) values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssiss", $firstName, $lastName, $email, $number, $gender, $password);
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>