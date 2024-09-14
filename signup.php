<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#06aa5e">
    <meta name="msapplication-navbutton-color" content="#06aa5e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Sign up | The L Group</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles.css">
    <script src="./script.js" defer>

    </script>
    <style>
   
    /* Text color for "Show Password" checkbox label */
    label[for="show_password_checkbox"] {
        color: white;
    }

    /* Text color for password complexity requirements */
    #password_requirements p,
    #password_requirements li {
        color: white;
    }
</style>
</head>
<body>
  
    <main class="card-container slideUp-animation">
        <div class="image-container">
            <h1 class="company">The L Group <sup>&trade;</sup></h1>
            <img src="./images/signUp.svg" class="illustration" alt="">
            <p class="quote">Sign up today to get exciting offers..!</p>
            <a href="#btm" class="mobile-btm-nav">
                <img src="./images/dbl-arrow.png" alt="">
            </a>
        </div>
     <form id="form" action="../inserting.php" method="post" onsubmit="return checkForm()">
    <div class="form-container slideRight-animation">
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); // Clear the error message
        }
        ?>
        <div id="id_validation_message" style="display: none; color: red;"></div>
        <div id="phone_validation_message" style="display: none; color: red;"></div>
        <h1 class="form-header">
            Get started
        </h1>

        <div class="input-container">
            <label for="id_num"></label>
            <input type="text" name="id_num" id="id_num" maxlength="13" required/>
            <span>ID Number</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="name"></label>
            <input type="text" id="name" name="name" required/>
            <span>Full name</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="mail"></label>
            <input type="email" name="email" id="email" required>
            <span>E-mail</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="phone"></label>
            <input type="text" name="phone_number" id="phone_number" required>
            <span>Phone</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="street"></label>
            <input type="text" name="street"  required>
            <span>Street</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="state"></label>
            <input type="text" name="state" id="state" required>
            <span>State</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="zip"></label>
            <input type="text" name="zip_code" id="zip_code" required>
            <span>Zip Code</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="user-password"></label>
            <input type="password" name="password" id="password" class="user-password" required>
            <span>Password</span>
            <div class="error"></div>
        </div>

        <div class="input-container">
            <label for="user-password-confirm"></label>
            <input type="password" name="confirm_password" id="confirm_password" class="password-confirmation" required>
            <span>Confirm Password</span>
            <div class="error"></div>
        </div>

        <div id="password_match_message" style="display: none; color: red;">Passwords do not match!</div>

        <div id="password_requirements">
            <p>Password must contain:</p>
            <ul>
                <li id="special_character">At least one special character (e.g., !, @, #)</li>
                <li id="number">At least one numeric digit (0-9)</li>
                <li id="lowercase">At least one lowercase letter (a-z)</li>
                <li id="uppercase">At least one uppercase letter (A-Z)</li>
            </ul>
        </div>

        <div id="btm">
            <button id="button" type="submit" class="submit-btn">Create Account</button>
            <p class="btm-text">
                Already have an account..? <span class="btm-text-highlighted"> <a href="./login.php">Log in</a></span>
            </p>
        </div>
    </div>
</form>

    </main>
   
</body>

<script>
    //---
    
  
    

    //---





    // Function to hide the error message after 2 seconds
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 2000);
    
    //password visibility
    function PasswordVisibility() {
        var passwordInputs = document.querySelectorAll('input[type="password"]');
        var showPasswordCheckbox = document.getElementById('show_password_checkbox');
        
        passwordInputs.forEach(function(input) {
            input.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });
    }
    
    //form validating
    function checkForm() {
        if (!checkPasswordMatch()) {
            return false;
        }

        if (!checkIdInput()) {
            return false;
        }
        
        if (!checkPhoneNumber()) {
            return false;
        }

        return true;
    }
    
    //Password validation
    function checkPasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var password_match_message = document.getElementById('password_match_message');

        // Check if passwords match
        if (password !== confirmPassword) {
            password_match_message.innerText = 'Passwords do not match!';
            password_match_message.style.display = 'block';
            setTimeout(function() {
                password_match_message.style.display = 'none';
            }, 2000);
            return false;
        }

        // Check if password meets complexity requirements
        var hasSpecialChar = /[^a-zA-Z0-9]/.test(password); // At least one special character
        var hasNumericDigit = /\d/.test(password); // At least one numeric digit
        var hasLowerCase = /[a-z]/.test(password); // At least one lowercase letter
        var hasUpperCase = /[A-Z]/.test(password); // At least one uppercase letter

        if (!hasSpecialChar || !hasNumericDigit || !hasLowerCase || !hasUpperCase) {
            password_match_message.innerText = 'Password must contain at least one special character, one numeric digit, one lowercase letter, and one uppercase letter!';
            password_match_message.style.display = 'block';
            setTimeout(function() {
                password_match_message.style.display = 'none';
            }, 5000); // Longer display time for complex password requirement
            return false;
        }

        return true;
    }

    //id validation
    function checkIdInput() {
    var idInput = document.getElementById('id_num').value;
    var id_validation_message = document.getElementById("id_validation_message");

    // Check if input is 13 digits long
    if (idInput.length !== 13) {
        id_validation_message.innerText = "ID number must be 13 digits long";
        id_validation_message.style.display = 'block';
        setTimeout(function() {
            id_validation_message.style.display = 'none';
        }, 2000); // Hide the message after 2 seconds
        return false;
    }

    // Check if input consists of numbers only
    if (!/^\d+$/.test(idInput)) {
        id_validation_message.innerText = "ID number must contain only numeric digits";
        id_validation_message.style.display = 'block';
        setTimeout(function() {
            id_validation_message.style.display = 'none';
        }, 2000); // Hide the message after 2 seconds
        return false;
    }

    // Extract the first 6 digits representing the date of birth
    var dobPart = idInput.substring(0, 6);
    var year = dobPart.substring(0, 2);
    var month = dobPart.substring(2, 4);
    var day = dobPart.substring(4, 6);

    // Adjust year for 1900s or 2000s
    var currentYear = new Date().getFullYear();
    var fullYear = (currentYear % 100) >= parseInt(year) ? '20' + year : '19' + year;

    // Check if the first 6 digits form a valid date of birth
    var dateOfBirth = new Date(fullYear, month - 1, day);
    if (dateOfBirth.getFullYear() != fullYear || dateOfBirth.getMonth() != (month - 1) || dateOfBirth.getDate() != day) {
        id_validation_message.innerText = "Invalid date of birth in ID number";
        id_validation_message.style.display = 'block';
        setTimeout(function() {
            id_validation_message.style.display = 'none';
        }, 2000); // Hide the message after 2 seconds
        return false;
    }

    // Checksum validation using Luhn algorithm
    

    id_validation_message.innerText = ""; // Clear any previous error message
    id_validation_message.style.display = 'none'; // Hide the error message
    return true;
}

function luhnCheck(id) {
    var sum = 0;
    var shouldDouble = false;
    for (var i = id.length - 1; i >= 0; i--) {
        var digit = parseInt(id.charAt(i));
        if (shouldDouble) {
            digit *= 2;
            if (digit > 9) {
                digit -= 9;
            }
        }
        sum += digit;
        shouldDouble = !shouldDouble;
    }
    return (sum % 10) == 0;
}

  // Phone number validation
function checkPhoneNumber() {
    var phoneNumber = document.getElementById('phone_number').value;
    var phone_validation_message = document.getElementById("phone_validation_message");

    // Check if input consists of exactly 10 digits
    if (!/^\d{10}$/.test(phoneNumber)) {
        phone_validation_message.innerText = "Phone number must be 10 digits long and contain only numbers!";
        phone_validation_message.style.display = 'block';
        setTimeout(function() {
            phone_validation_message.style.display = 'none';
        }, 2000); // Hide the message after 2 seconds
        return false;
    }

    phone_validation_message.innerText = ""; // Clear any previous error message
    phone_validation_message.style.display = 'none'; // Hide the error message
    return true;
}

    //
    // Get the password input field
var passwordInput = document.getElementById('password');

// Add event listener for input event
passwordInput.addEventListener('input', function() {
    var password = passwordInput.value;

    // Check if password contains at least one special character
    var hasSpecialChar = /[^a-zA-Z0-9]/.test(password); // At least one special character
    updateStatus(hasSpecialChar, 'special_character');

    // Check if password contains at least one numeric digit
    var hasNumericDigit = /\d/.test(password); // At least one numeric digit
    updateStatus(hasNumericDigit, 'number');

    // Check if password contains at least one lowercase letter
    var hasLowerCase = /[a-z]/.test(password); // At least one lowercase letter
    updateStatus(hasLowerCase, 'lowercase');

    // Check if password contains at least one uppercase letter
    var hasUpperCase = /[A-Z]/.test(password); // At least one uppercase letter
    updateStatus(hasUpperCase, 'uppercase');
});

// Update color of each requirement text
function updateStatus(hasRequirement, elementId) {
    var element = document.getElementById(elementId);

    if (hasRequirement) {
        element.style.color = 'green'; // Set color to green if requirement is met
    } else {
        element.style.color = 'red'; // Set color to red if requirement is not met
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
</html>