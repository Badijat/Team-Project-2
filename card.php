<?php
// Check if form is submitted successfully
if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["number"]) && isset($_POST["birthDate"]) && isset($_POST["gender"]) && isset($_POST["cardType"])) {
    
    // Store form data in variables
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $birthDate = $_POST["birthDate"];
    $gender = $_POST["gender"];
    $cardType = $_POST["cardType"];
    
    // Create MySQL database connection
    $conn = new mysqli("localhost", "root", "ROOT", "tproject");
    
    // Check connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Insert form data into MySQL database
    $sql = "INSERT INTO cards (firstName, lastName, email, number, birthDate, gender, cardType) VALUES ('$firstName', '$lastName', '$email', '$number', '$birthDate', '$gender', '$cardType')";
    
    if($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close database connection
    $conn->close();
}
else {
    echo "Form not submitted.";
}
?>


