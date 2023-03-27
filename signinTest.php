<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testValidLogin(): void {
        // Start session
        session_start();

        // Set up the input data
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'exampleuser';
        $_POST['password'] = 'examplepass';

        // Include the login script
        include 'login.php';

        // Assert that the session variable was set and the user was redirected
        $this->assertEquals('exampleuser', $_SESSION['user']);
        $this->assertStringContainsString('Location: home.html', implode(' ', headers_list()));
    }

    public function testInvalidLogin(): void {
        // Start session
        session_start();

        // Set up the input data
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'invaliduser';
        $_POST['password'] = 'invalidpass';

        // Include the login script
        include 'login.php';

        // Assert that the error message was set and the user was not redirected
        $this->assertStringContainsString('Invalid username or password.', $error);
        $this->assertEmpty(headers_list());
    }
}