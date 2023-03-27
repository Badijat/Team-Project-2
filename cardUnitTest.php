<?php

use PHPUnit\Framework\TestCase;

class FormSubmitTest extends TestCase
{


    public function testFormSubmit()
    {
        // Set up the POST data
        $_POST = array(
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'johndoe@example.com',
            'number' => '1234 5678 9012 3456',
            'birthDate' => '1990-01-01',
            'gender' => 'male',
            'cardType' => 'Visa'
        );

        // Capture the output of the PHP script
        ob_start();
        include 'submit-form.php';
        $output = ob_get_clean();

        // Check that the output contains the expected string
        $this->assertContains('Data inserted successfully.', $output);
    }
}
