<?php
session_start();
// Include the database connection file
include 'connecting.php';

// Include PHPMailer libraries
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

// Function to check if a string contains only letters (including spaces)
function isValidLetters($str) {
    return preg_match('/^[a-zA-Z\s]+$/', $str);
}

// Function to check if a string contains only digits
function isValidNumbers($str) {
    return preg_match('/^[0-9]+$/', $str);
}

// Collect form data
$name = $_POST['name'];
$id = $_POST['id_num'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone_number'];
$state = $_POST['state'];
$street = $_POST['street'];
$zip_code = $_POST['zip_code'];

// Validate inputs
if (!isValidLetters($state)) {
    $_SESSION['error'] = "State should contain only letters";
    header("Location: ../web/modified form/signup.php");
    exit();
}



if (!isValidNumbers($zip_code)) {
    $_SESSION['error'] = "Zip Code should contain only numbers";
    header("Location: ./signup.php");
    exit();
}

// Check if the email already exists in the database
$sql_check_email = "SELECT * FROM customers WHERE email='$email'";
$result_check_email = $conn->query($sql_check_email);

// Check if the id_num already exists in the database
$sql_check_id = "SELECT * FROM customers WHERE cus_id_number='$id'";
$result_check_id = $conn->query($sql_check_id);

if ($result_check_email->num_rows > 0) {
    // Email already exists, set error message in session
    $_SESSION['error'] = "Email already exists";
    header("Location: ./signup.php");
    exit();
} elseif ($result_check_id->num_rows > 0) {
    // ID number already exists, set error message in session
    $_SESSION['error'] = "ID number already exists";
    header("Location: ./signup.php");
    exit();
}

$encrypt = md5($password);

// Insert data into database
$sql = "INSERT INTO customers (cus_id_number, name, email, phone_number, password, street, state, zip) VALUES ('$id', '$name', '$email', '$phone', '$encrypt', '$street', '$state', '$zip_code')";

if ($conn->query($sql) === TRUE) {
    // Database insertion successful, proceed to send email
    
    // Initialize PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mahlanguzakhele063@gmail.com'; // Replace with your Gmail email address
        $mail->Password = 'yyszmmomkdjtugpx'; // Replace with your Gmail password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('mahlanguzakhele063@gmail.com', 'Group L Clothes Designer'); // Replace with your name and email address
        $mail->addAddress($email); // Recipient's email address
        $mail->addReplyTo('mahlanguzakhele063@gmail.com', 'Information'); // Optional reply-to address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Registration approved';
        $mail->Body = "Hello <b>$name</b>, you've been successfully registered."; // HTML body content
        $mail->AltBody = ''; // Plain text alternative

        // Send email
        $mail->send();

        // Redirect to registration successful page after email is sent
        header("Location: ./registered.php");
        exit();
    } catch (Exception $e) {
        // Error handling if email sending fails
        $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: ./signup.php");
        exit();
    }
} else {
    // Display error message if insertion fails
    $_SESSION['error'] = "Error occurred..Details Already exist: " . $conn->error;
    header("Location: ./signup.php");
    exit();
}

$conn->close(); // Close database connection
?>
