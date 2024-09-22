<?php
//staring session
session_start();
include 'connecting.php';
//get session
if(isset($_SESSION['customer_id'] )){
     $id = $_SESSION['customer_id'];
     
}

$query_design = "SELECT * FROM `design` WHERE cus_id_number = '$id' ORDER BY timestamp_column desc limit 1";
$result_design = mysqli_query($conn, $query_design);

function getTshirtImage($color)
{
    switch ($color) {
        case 'black':
            return 'https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/black.png';
        case 'blue':
            return 'https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/blue.png';
        case 'red':
            return 'https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/red.png';
        case 'white':
        default:
            return 'https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/white.png';
    }
}






// add to cart
if(isset($_POST['add_to_cart'])){
   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];//missing
   $product_price = $_POST['product_price'];//missing
   $product_image = $_POST['product_image'];//missing
   $text_color = $_POST['text_color'];//missing
   $cloth_color = $_POST['cloth_color'];//missing
   $text_size = $_POST['text_size'];//missing
   $text = $_POST['text'];//missing
   $vertical = $_POST['vertical'];//missing
   $product_quantity = 1;
  
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE product_id = '$product_id' AND  cus_id_number = '$id'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
    

    //$vertical = isset($_POST['vertical']) ? 1 : 0;
      //$insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity,product_id,cus_id_number,text_color,text_size,text) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity',' $product_id','$id','$text_color','$text_size','$text')");
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity,product_id,cus_id_number,text_color,text_size,text,cloth_color,vertical) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity',' $product_id','$id','$text_color','$text_size','$text','$cloth_color','$vertical')");

      if ($insert_product) {
          // Update the 'hidden' flag for the product to hide it
          $query_hide_product = "UPDATE `products` SET hidden = 1 WHERE product_id = '$product_id' AND cus_id_number = '$id'";
          $result_hide_product = mysqli_query($conn, $query_hide_product);
      
          if ($result_hide_product) {
              // Product hidden successfully
              $message[] = 'Product added to cart successfully and hidden from available products.';
          } else {
              // Error occurred while hiding the product
              $message[] = 'Product added to cart successfully but could not be hidden from available products.';
          }
      } else {
          // Failed to add the product to the cart
          $message[] = 'Failed to add the product to cart.';
      }
      
   }

}

$query = "SELECT * FROM `products` WHERE cus_id_number = '$id' ";
$result = mysqli_query($conn, $query);




?>
<?php
if(isset($_POST['delete_product'])){
    $delete_product_id = $_POST['delete_product_id'];
    
    // First, delete from cart table
    $delete_cart_query = mysqli_query($conn, "DELETE FROM `cart` WHERE product_id = '$delete_product_id' AND cus_id_number = '$id'");
    
    if($delete_cart_query){
        // If deletion from cart table is successful, delete from products table
        $delete_product_query = mysqli_query($conn, "DELETE FROM `products` WHERE product_id = '$delete_product_id' AND cus_id_number = '$id'");
        //$delete_product_query = mysqli_query($conn, "DELETE FROM `design` WHERE design_id = '$delete_product_id' AND cus_id_number = '$id'");
        if($delete_product_query){
            $message[] = 'Product deleted successfully';
        } else {
            $message[] = 'Failed to delete product from products table';
        }
    } else {
        $message[] = 'Failed to delete product from cart';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 20px;
}

.heading {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.box {
    width: 200px;
    padding: 20px;
    margin: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.box img {
    width: 100px;
    height: 100px;
    margin-bottom: 15px;
}

.btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.message {
    padding: 10px;
    margin-bottom: 10px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    border-radius: 4px;
    position: relative;
}

.message span {
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
}

.message i {
    position: absolute;
    top: 50%;
    right: 5px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #155724;
}

.tshirt-preview {
    width: 500px;
    height: 500px;
    background-size: cover;
    background-position: center;
    position: relative;
    margin: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-sizing: border-box;
    padding: 20px;
}

.text-preview {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 100%;
    height: 100%;
    word-wrap: break-word;
    margin: 0;
}

.button-container {
    width: 100%;
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.button-container .btn {
    flex: 1;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
}

.button-container .btn:hover {
    background-color: #0056b3;
}

   </style>
</head>
<body>
      <!--session name -->
      <?php
    
    if (isset($_SESSION['customer_name'])) {
        $name = $_SESSION['customer_name'];
    }
    ?>
<nav class="navbar navbar-dark bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">The L Group &trade; </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel"><?php echo $name; ?></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
         
           <li class="nav-item">
            <a class="nav-link" href="./ii/orderedItems.php">Order</a>
          </li>
        </ul>
        
      </div>
    </div>
  </div>
</nav>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};


$query = "SELECT * FROM `products` WHERE cus_id_number = '$id' AND hidden = 0";
$result = mysqli_query($conn, $query);


?>

<div class="container">

<section class="products">

   <h1 class="heading">products</h1>

   <div class="box-container">

   <?php
if(isset($_SESSION['customer_id'])){
    $id = $_SESSION['customer_id'];
}

$select_products = mysqli_query($conn,"SELECT * FROM `products` WHERE cus_id_number = '$id' AND hidden = 0");

if(mysqli_num_rows($select_products) > 0){
    while($fetch_product = mysqli_fetch_assoc($select_products)){
        if(file_exists("../image/" . $fetch_product['image'])){
?>
            <form action="" method="post">
                <div class="box">
                    <?php echo $fetch_product['name']; ?>
                    <img width="100" height="100" src="../image/<?php echo $fetch_product['image']; ?>" alt="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $fetch_product['product_id']; ?>">
                    <input type="hidden" name="text_color" value=null>
                    <input type="hidden" name="text_size" value=null>
                    <input type="hidden" name="vertical" value="0">

                    <input type="hidden" name="cloth_color" value=null>
                    <input type="hidden" name="text" value=null>
                    <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                    <form action="" method="post">
                        <input type="hidden" name="delete_product_id" value="<?php echo $fetch_product['product_id']; ?>">
                       
                    </form>
                </div>
            </form>
<?php
        }
    }
}
?>


<?php
if(isset($_SESSION['customer_id'])){
    $id = $_SESSION['customer_id'];
}



$select_products = mysqli_query($conn,"SELECT * FROM `products` WHERE cus_id_number = '$id' AND hidden = 0 And image LIKE '%plain shirt%' ORDER BY timestamp_column desc limit 1");

if(mysqli_num_rows($select_products) > 0){
  while($id_product = mysqli_fetch_assoc($select_products)){
?>
<?php
if (mysqli_num_rows($result_design) > 0) {
while($row = mysqli_fetch_assoc($result_design)){
        $tshirtImage = getTshirtImage($row['cloth_color']);
        echo '<div class="tshirt-preview" style="background-image: url(\'' . $tshirtImage . '\');">
        <div class="text-preview" style="color: ' . htmlspecialchars($row['text_color']) . '; font-size: ' . htmlspecialchars($row['text_size']) . 'px;">';
        if(  htmlspecialchars($row['vertical'])==1){
        $text = htmlspecialchars($row['text']);
        $lines = str_split($text, 1);
        foreach ($lines as $line) {
            echo $line . '<br>';
        }
    }else{
        $text = htmlspecialchars($row['text']);
        $lines = str_split($text, 20);
        foreach ($lines as $line) {
            echo $line . '<br>';
        }
    }
        

    
    // Join lines with line breaks
    echo '</div>
        <div class="button-container">
            <form action="" method="post">


            
            <input type="hidden" name="product_name" value="' .  htmlspecialchars($id_product['name']) . '">
            <input type="hidden" name="product_price" value="' . 70 . '">
            <input type="hidden" name="product_image" value="' . $tshirtImage . '">
            <input type="hidden" name="text_color" value="' . htmlspecialchars($row['text_color']) . '">
            <input type="hidden" name="cloth_color" value="' . htmlspecialchars($row['cloth_color']) . '">
            <input type="hidden" name="text_size" value="' . htmlspecialchars($row['text_size']) . '">
            <input type="hidden" name="vertical" value="' . htmlspecialchars($row['vertical']) . '">
            <input type="hidden" name="text" value="' . htmlspecialchars($row['text']) . '">
            <input type="hidden" name="product_id" value="' . htmlspecialchars($id_product['product_id']) . '">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart" ">
            </form>
            <form action="" method="post">
            <input type="hidden" name="delete_product_id" value="' . htmlspecialchars($id_product['product_id']) . '">
               
            </form>
        </div>
    </div>';
}
}
?>
<?php 
  }
}
?>



   </div>

</section>

</div>


<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
