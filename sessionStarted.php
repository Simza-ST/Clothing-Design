<?php
session_start();
// Get database connection
include 'connecting.php';
// Retrieve form data
$email_or_id = $_POST['email_or_id'];
$password = $_POST['password'];

// Query to check if user with given email or ID exists
$sql = "SELECT * FROM customers WHERE email=? OR cus_id_number=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email_or_id, $email_or_id);
$stmt->execute();
$result = $stmt->get_result();

// function decrypt($encrypted) {
//     $decrypted = "";
    
//     // Finding midpoint of encrypted string
//     $mid = strlen($encrypted) / 2;
    
//     // Getting the first part of the encrypted string
//     $firstPart = substr($encrypted, 0, $mid);
    
//     // Decrypting
//     for ($i = 0; $i < strlen($firstPart); $i++) {
//         $ch = $firstPart[$i];
//         $ch = chr(ord($ch) - 3);
//         $decrypted .= $ch;
//     }
    
//     return $decrypted;
// }

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    
    // Decrypting the stored password
    //$dbPassword = decrypt($user['password']);
    $encrypt = md5($password);
    
    // Comparing the decrypted password with the provided password
    if ($encrypt === $user['password']) {
        // Password matches, store user data in session and redirect to restricted page
        $_SESSION['email_or_id'] = $email_or_id; // Store user identifier in session if needed
        header("Location: home.php");
        exit;
    } else {
        // Password doesn't match, redirect back to login page with error message
        header("Location: ./login.php?error=2");
        exit;
    }
} else {
    // User not found, redirect back to login page with error message
    header("Location: ./login.php?error=1");
    exit;
}
?>
