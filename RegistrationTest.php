<?php
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    public function setUp(): void
    {
        // Set up the test database
        $this->conn = new mysqli('localhost', 'root', 'ROOT', 'test_database');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function tearDown(): void
    {
        // Clean up the test database after each test
        $this->conn->query("DELETE FROM registration");
        $this->conn->close();
    }
    
    public function testRegistrationSuccess()
    {
        // Test a successful registration
        $postData = array(
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'number' => '1234567890',
            'gender' => 'male',
            'password' => 'password123'
        );
        
        // Simulate a form submission by passing the test data to the script
        $_POST = $postData;
        ob_start();
        include 'registration.php';
        $output = ob_get_clean();
        
        // Assert the expected output
        $this->assertEquals('1Registration successfully...', $output);
        
        // Assert the expected data in the test database
        $result = $this->conn->query("SELECT * FROM registration");
        $this->assertEquals(1, $result->num_rows);
        $row = $result->fetch_assoc();
        $this->assertEquals($postData['firstName'], $row['firstName']);
        $this->assertEquals($postData['lastName'], $row['lastName']);
       
