
<?php
// Assuming you have a MySQL database connection established
include "../dp.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if propertyId parameter is set
if(isset($_GET['id'])) {
    // Get propertyId from the URL parameter
    $propertyId = $_GET['id'];

    // Update the status of the property to 1 (considering 0 as active and 1 as deleted)
    $updateSql = "UPDATE features SET Status = 1 WHERE id = $propertyId";
    if ($conn->query($updateSql) === TRUE) {
        // Redirect back to the main page after updating
        header("Location: ../features.php");
        exit();
    } else {
        // Handle the error if the update fails
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Redirect to the main page if propertyId is not provided
    header("Location: main_page.php");
    exit();
}

// Close the database connection
$conn->close();
?>