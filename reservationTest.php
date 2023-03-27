<?php
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = new mysqli('localhost', 'root', 'ROOT', 'tproject');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void {
        $this->conn->query("DELETE FROM reservations");
        $this->conn->close();
    }

    public function testReservation(): void {
        $formData = [
            'check_in' => '2023-04-01',
            'check_out' => '2023-04-03',
            'adults' => 2,
            'childs' => 1,
            'Trips' => 'Test Trip',
            'station' => 'Test Station'
        ];

        $this->assertEmpty($this->conn->query("SELECT * FROM reservations"));

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = $formData;
        include "reservation.php";

        $this->assertNotEmpty($this->conn->query("SELECT * FROM reservations"));
    }
}