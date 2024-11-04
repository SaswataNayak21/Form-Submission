<?php
$insert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    // Set connection variables 
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Collect POST variables
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email  = $_POST['email'];
    $phone = $_POST['phone'];
    $other = $_POST['other'];
    $sql = "INSERT INTO `trip`.`trip` ( `name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) 
            VALUES ('$name', '$age', '$gender', '$email', '$phone', '$other', current_timestamp());";

    // Execute the query
    if ($con->query($sql) == true) {
        // Set flag for successful insertion
        $insert = true;
    } else {
        echo "Error inserting data: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="image.png" alt="KIIT University">
    <div class="container">
        <h1>KIT University US Trip form</h1>
        <p>Enter your details and submit this form to confirm your participation in the trip.</p>

        <!-- Display the thank you message only after form submission -->
        <?php
        if ($insert == true) {
            echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the US trip!</p>";
        }
        ?>

        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="text" name="age" id="age" placeholder="Enter your Age" required>
            <input type="text" name="gender" id="gender" placeholder="Enter your gender" required>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="phone" name="phone" id="phone" placeholder="Enter your phone" required>
            <textarea name="other" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button> 
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
