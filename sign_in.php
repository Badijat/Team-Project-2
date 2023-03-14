<?php
// Start session
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the input data
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  // Check if the username and password are valid
  if ($username === 'exampleuser' && $password === 'examplepass') {
    // Valid credentials, set session variables
    $_SESSION['user'] = $username;
    // Redirect to the home page
    header('Location: home.html');
    exit;
  } else {
    // Invalid credentials, show an error message
    $error = 'Invalid username or password.';
  }
}
?>
