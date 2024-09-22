<?php
// Start session
session_start();
// Include database connection
include 'connecting.php';

// Get SESSION
if (isset($_SESSION['email_or_id'])) {
    $email_or_id = $_SESSION['email_or_id'];
}

// Fetch the name and ID based on the email/id
$query = "SELECT cus_id_number, name FROM customers WHERE (email = '$email_or_id' OR cus_id_number ='$email_or_id')";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$id_number = $row['cus_id_number'];
$name = $row['name'];

// Set ID and name in session
$_SESSION['customer_id'] = $id_number;
$_SESSION['customer_name'] = $name;


// Replace 15 with the actual cart_id you want to retrieve
$sql = "SELECT sum(quantity) FROM cart WHERE cus_id_number = $id_number";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lacquer&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Grandstander:ital,wght@0,100..900;1,100..900&family=Lacquer&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/0d8e1c9927.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Grandstander:ital,wght@0,100..900;1,100..900&family=Lacquer&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Freehand&family=MedievalSharp&family=VT323&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Freckle+Face&family=Freehand&family=MedievalSharp&family=VT323&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">The L Group &trade; </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?php echo $name; ?></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="designPreview.php">Saved Design</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="complaint.php">Complaints</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./ii/orderedItems.php">Order</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
    <div style="margin: 20px;">
        <?php
        // Check if there are any rows in the result set
        if ($result->num_rows > 0) {
            // Fetch the quantity from the first row
            $row = $result->fetch_assoc();
            $quantity = $row["sum(quantity)"];

            // Display the cart icon with the retrieved quantity
            echo "<div class='cart-icon'>
    <a href= cart.php>  <img src='bs.jpg' alt='Basket Icon' width='30px' height='30px'>  </a>
            <span class='cart-quantity'>" . $quantity . "</span>
          </div>";
        } else {
            // If no rows are found, display the cart icon with a quantity of 0
            echo "<div class='cart-icon'>
              <img src='bs.jpg' alt='Basket Icon' width='30px' height='30px'>
              <span class='cart-quantity'>0</span>
          </div>";
        }
        ?>
    </div>

    <form action="selected.php" method="post">

        <div class="clothing-item-section">
            <h4>Select your Clothing Item </h4>
            <div class="logos">
                <div class="logo-item-clothing" data-index="0">
                    <div class="image-holder"><img src="./plain shirt.jpeg" alt=""></div>
                    <div class="logo-text"><input type="radio" id="shirt" name="clothes" value="shirt" value="t-shirt">
                        <label for="shirt">T shirt</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-clothing" data-index="1">
                    <div class="image-holder"><img src="./plain jacket.jpeg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="jacket" name="clothes" value="jacket">
                        <label for="jacket">Jacket</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div for="hoodie" class="logo-item-clothing" data-index="2">
                    <div class="image-holder"><img src="./plain hoodie.jpeg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="hoodie" name="clothes" value="hoodie">
                        <label for="hoodie">Hoodie</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>

            </div>

        </div>

        <div class="fabric-section">
            <h4>Select your fabric</h4>
            <div class="logos">
                <div class="logo-item-fabric" data-index="0">
                    <div class="image-holder"><img src="./cotton.jpeg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="cotton" name="fabric" value="cotton">
                        <label for="shirt">Cotton</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-fabric" data-index="1">
                    
                    <div class="image-holder"><img src="./polyster.jpeg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="polyster" name="fabric" value="polyster">
                        <label for="hoodie">Polyster</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-fabric" data-index="2">
                    <div class="image-holder"><img src="./rayon.jpeg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="rayon" name="fabric" value="rayon">
                        <label for="jacket">Rayon</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>

            </div>

        </div>

        <div class="graphic-design-section">
            <h4>Color Designs</h4>
            <div class="logos">
                <div class="logo-item-color" data-index="0">
                    <div class="image-holder"><img src="black.jpg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="black" name="color" value="black">
                        <label for="black">Black</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-color" data-index="1">
                    <div class="image-holder"><img src="white.jpg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="white" name="color" value="white">
                        <label for="white">White</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-color" data-index="3">
                    <div class="image-holder"><img src="red.jpg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="red" name="color" value="red">
                        <label for="red">Red</label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
            </div>

        </div>

        <div class="size-section">
            <h4>Select your Size</h4>
            <div class="size">
                <label for="size" style="font-family: 'Poppins'; font-size: 20px;">Size:</label>
                <select name="size" id="size"
                    style="font-family: 'Poppins'; font-size: 20px; border: 1px solid #d1d1d1;">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </div>
        </div>

        <div class="graphic-design-section">
            <h4>Logo Selections</h4>
            <div class="logos">
                <div class="logo-item-color" data-index="0">
                    <div class="image-holder"><img src="java.jpg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="java" name="logo" value="java">
                        <label for="java">Java </label>
                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-color" data-index="1">
                    <div class="image-holder"><img src="starglow.jpg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="starglow" name="logo" value="starglow">
                        <label for="starglow">Starglow</label>

                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>
                <div class="logo-item-color" data-index="2">
                    <div class="image-holder"><img src="bleno.jpg" alt=""></div>
                    <div class="logo-text">
                        <input type="radio" id="bleno" name="logo" value="bleno">
                        <label for="bleno">Bleno</label>

                    </div>
                    <div class="selected"><i class="fa fa-check"></i></div>
                </div>

            </div>

            <div class="submit-button" style="margin-top: 20px;">
                <button type="submit" name="add_to_cart" style="font-family: 'Poppins'; font-size: 20px; margin: auto;">
                    Submit For Preview
                </button>
            </div>


        </div>
    </form>
    <!-- for t-shirt design with text-->
    <div class="text-design-form">
        <h4>Design using text</h4>

        </form>
        <div id="text-preview">Submit Text For Preview Text</div>
        <p>
            <a href="designTshirt.php">text T-shirt</a>
        </p>
    </div>
</body>
<script src="./script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>