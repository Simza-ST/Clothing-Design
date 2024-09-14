<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Clothing-Design</title>
    <style>
        body, html {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.login-container {
    display: flex;
    height: 100vh; /* Using viewport height to ensure the container takes full height */
}

.left-half, .right-half {
    flex: 1;
    height: 100%;
}

.left-half {
    background-color: #1d2b3a; /* Light background color */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.right-half {
           background-image: url('./images/t-shirt-designs.jpg');
		   background-size: cover;
		   background-position: center;
		   background-repeat: no-repeat;
        }
        .login-form {
    width: 100%;
    max-width: 400px;
    padding: 50px;
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.login-form h2, .login-form h4 {
    margin: 0 0 20px; /* Added spacing below headings */
    color: #333; /* Dark text color */
    font-family: "Times New Roman', Times, serif";
}

.login-form p {
    margin: 10px 0; /* Added spacing below error messages */
}

.login-form input[type="text"],
.login-form input[type="password"],
.login-form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px; /* Increased bottom margin for better spacing */
    border: 2px solid #bb5526;
    border-radius: 4px;
    box-sizing: border-box;
}

.login-form button {
    background-color: #a08f45;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s; /* Added transition effect */
}

.login-form button:hover {
    background-color: #a77d23d7; /* Darken the background color on hover */
}

/* Styling for the "Show Password" checkbox */
.checkbox-container {
    display: flex;
    align-items: center;
}

#show-password-label {
    margin-left: 5px; /* Added spacing between checkbox and label */
    color: #333; /* Dark text color */
    cursor: pointer;
}

    </style>
</head>
<body>
<div class="login-container">
        <div class="left-half">
            <div class="login-form">
                <h4>LOGIN</h4>
				<h2>HELLO WELCOME</h2>
                <?php
        // Check if error parameter is present in the URL
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p style="color: red;">User not found. Please try to sign up.</p>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 2) {
            echo '<p style="color: red;">Invalid password. Please try again.</p>';
        }
        ?>
                <form action="../SessionStarted.php" method="post">
                <input type="text" name="email_or_id" placeholder="example@gmail.com/ID Number" max="13" required/>
            <input id="password" type="password" name="password" placeholder="Enter your password" required/>
            <table>
                <tr>
                    <td><input type="checkbox" id="show-password" onclick="myFunction()" /></td>
                    <td><label for="show-password">Show Password</label></td>
                    
                </tr>
            </table>
            <button type="submit">Login</button>
					
                </form>
                <br>Click <a href="signup.php">Sign Up</a> to create an account with us or</br>Click <a href="./emails.php">forgot password</a> if you forgot your password<br>
            <a href="https://swp-qesb.onrender.com">LOG IN AS ADMIN</a></h5>
				
            </div>
        </div>
        <div class="right-half">
            <!-- Content for the right half 
            <img src="./Clothing Design.gif" alt="">-->
        </div>
    </div>
    <script>
    // Function to toggle password visibility
    function myFunction() {
        var passwordField = document.getElementById('password');
        var passwordCheckbox = document.getElementById('show-password');
        if (passwordField && passwordCheckbox) {
            passwordField.type = passwordCheckbox.checked ? 'text' : 'password';
        }
    }

    // Function to hide the error message after 2 seconds if it's visible
    setTimeout(function() {
        var errorMessage = document.querySelector('.container p');
        if (errorMessage && errorMessage.style.display !== 'none') {
            errorMessage.style.display = 'none';
        }
    }, 2000);
</script>
</body>
</html>