<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design a T-shirt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }

        .heading {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .tshirt-preview {
            width: 300px;
            height: 400px;
            background-image: url('https://res.cloudinary.com/dkkgmzpqd/image/upload/v1545217305/T-shirt%20Images/white.png');
            background-size: cover;
            background-position: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .tshirt-preview .text-preview {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            color: #000;
            text-align: center;
            white-space: pre-wrap; /* Ensures newlines are displayed correctly */
        }

        .inputBox {
            margin-bottom: 20px;
        }

        .inputBox span {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .inputBox input,
        .inputBox select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
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
    </style>
    
</head>

<body>
    <div class="container">
        <h1 class="heading">Design Your T-shirt</h1>
        <div class="tshirt-preview">
            <div class="text-preview" id="textPreview">Your Text Here</div>
        </div>
        <form action="save_design.php" method="post">
            <div class="inputBox">
                <span>Text</span>
                <textarea id="designText" name="designText" placeholder="Enter your text"
                    oninput="updatePreview()" rows="3" cols="17" maxlength="200" required></textarea>

                <!-- Buttons for text orientation -->
                <div style="margin-top: 10px;">
                    <input type="checkbox" id="vertical" name="vertical"  onchange="updatePreview()">
                    <label for="vertical">Vertical</label>
                </div>
            </div>

        

            <div class="inputBox">
                <span>Name</span>
                <input type="text" id="name" name="name" placeholder="Enter T shirt name" oninput="updatePreview()"
                    required>
            </div>

            <div class="inputBox">
                <span>Text Color</span>
                <input type="color" id="textColor" name="textColor" value="#000000" oninput="updatePreview()">
            </div>

            <div class="inputBox">
                <span>Text Size</span>
                <input type="number" id="textSize" name="textSize" value="24" min="10" max="72"
                    oninput="updatePreview()">
            </div>

            <div class="inputBox">
                <span>T-shirt Color</span>
                <select id="tshirtColor" name="tshirtColor" onchange="updatePreview()">
                    <option value="white">White</option>
                    <option value="black">Black</option>
                    <option value="blue">Blue</option>
                    <option value="red">Red</option>
                </select>
            </div>

            <input type="submit" value="Save Design" class="btn">
        </form>
    </div>
	<script src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
