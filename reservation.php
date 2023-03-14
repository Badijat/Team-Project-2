<?php
// Replace with your MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "ROOT";
$dbname = "tproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $check_in = mysqli_real_escape_string($conn, $_POST["check_in"]);
    $check_out = mysqli_real_escape_string($conn, $_POST["check_out"]);
    $adults = intval($_POST["adults"]);
    $childs = intval($_POST["childs"]);
    $trips = mysqli_real_escape_string($conn, $_POST["Trips"]);
    $station = mysqli_real_escape_string($conn, $_POST["station"]);
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO reservations (check_in, check_out, adults, childs, trips, station) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiss", $check_in, $check_out, $adults, $childs, $trips, $station);

    // Execute statement
    if ($stmt->execute()) {
        echo "Reservation created successfully. Your seat number is " . $stmt->insert_id . ".";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
    
    // Close database connection
    $conn->close();
} else {
    echo "Form not submitted.";
}
?>
