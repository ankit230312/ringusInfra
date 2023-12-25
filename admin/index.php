<?php session_start();
 include "dp.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: You missed the name attribute for the password input in your HTML

    // Sanitize user input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check credentials
    $sql = "SELECT id, email, password FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, check password
        $row = $result->fetch_assoc();
        $hashedPasswordFromDB = $row['password'];

        // Verify password
        if (password_verify($password, $hashedPasswordFromDB)) {
			$_SESSION['user'] = $row['email'];
			echo '<script >alert("login Success");</script>';
			echo '<script >window.location.href="dash.php";</script>';
			exit(); // Make sure to exit to prevent further execution of PHP code
        
        } else {
            // Password is incorrect
			echo '<script >alert("Wrong USername and Password");</script>';
        }
    } else {
        // User not found
		echo '<script >alert("user Not found");</script>';
    }
}

// Close the database connection
$conn->close();


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="wrapper">
            <form action="" method="post" id="wizard">
        		<!-- SECTION 1 -->
                <h4></h4>
                <section>
                    <div class="inner">
                    	<a href="#" class="avartar">
                    		<img src="2.png" alt="">
                    	</a>
                    	<div class="form-row">
                    		<div class="form-holder">
                    			<input type="text" class="form-control" name="email"  placeholder="User Name">
                    		</div> <br><br>
                    		<div class="form-row">
                    			<input type="password" name="password" class="form-control" password placeholder="User Password">
                    		</div>
                    	</div>
                        <div class="form-row">
                    		<div class="form-holder">
                    			<input type="submit" class="btn btn-primary" value="Login">
                    		</div>
                    	</div>
                    </div>
                </section>
            
            </form>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		
		<!-- JQUERY STEP -->
		<script src="js/jquery.steps.js"></script>

		<!-- DATE-PICKER -->
		<script src="vendor/date-picker/js/datepicker.js"></script>
		<script src="vendor/date-picker/js/datepicker.en.js"></script>

		<script src="js/main.js"></script>

<!-- Template created and distributed by Colorlib -->
</body>
</html>