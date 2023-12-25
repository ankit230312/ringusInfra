
<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Redirect to the login page or display an error message
    echo '<script type="text/javascript">window.location.href="index.php";</script>';
    exit();
}

include "common/header.php";
include "dp.php";

// Assuming you have a database connection $conn

if (isset($_POST['submit'])) {
    // Sanitize and validate input
    $features = isset($_POST['feature']) ? mysqli_real_escape_string($conn, $_POST['feature']) : '';
    $property_id = isset($_POST['property_id']) ? mysqli_real_escape_string($conn, $_POST['property_id']) : '';
    

    // Check if the pincode is not empty
    if (!empty($features)) {
        // Check if the pincode already exists
        $checkQuery = "SELECT * FROM features WHERE features = '$features'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Pincode already exists, show an error message
            echo "<script>alert('Duplicate Feature!')</script>";
            echo "Duplicate Feature!";
        } else {
            // Pincode does not exist, proceed to insert
            // Construct the SQL query
            $query = "INSERT INTO features (property_id,features, created, updated) VALUES ('$property_id','$features', CURDATE(), CURDATE())";

            // Execute the query
            $result = mysqli_query($conn, $query);

            // Check if the query was successful
            if ($result) {
                echo "<script>alert('Feature added successfully!')</script>";
                echo "Feature added successfully!";
            } else {
                // Handle query execution failure
                echo "Error adding Feature: " . mysqli_error($conn);
            }
        }
    } else {
        // Handle case when pincode is empty
        echo "Feature cannot be empty.";
    }
}

// Close the database connection
// mysqli_close($conn);
?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Features</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col"></div>

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Features</h4>
                        <p class="card-description"> </p>
                        <form class="form-sample" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Property Name</label>
                                        <div class="col-sm-9">
                                            <!-- <input type="text" name="feature" class="form-control" required /> -->
                                            <select name="property_id" id="property_id" class="form-control">
                                                <option value="">Select</option>
                                                <?php $sql = "SELECT * FROM propertyland where propertyName != ''";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch_assoc())
                                                {
                                                    echo "<option value='{$row['propertyId']}'>{$row['propertyName']}</option>";
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Feature</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="feature" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                            <button class="btn btn-dark">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col"></div>



        </div>


        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">Property List</h4>
                        <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
                        </p>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Property Name</th>
                                        <th>Features</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $sql = "SELECT * FROM features fe inner join propertyland pl on pl.propertyId =fe.property_id";
                                    $result = $conn->query($sql);
                                    // Check if there are rows in the result set
                                    if ($result->num_rows > 0) {
                                        // Loop through each row and populate the table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$row['id']}</td>";
                                            echo "<td>{$row['propertyName']}</td>";
                                            
                                            echo "<td>{$row['features']}</td>";
                                            echo "<td>{$row['created']}</td>";
                                            echo "<td>" . ($row['status'] == 0 ? 'Active' : 'Deactivate') . "</td>";
                                            // Fetch property images for the current propertyId from propertyimages table
                                        

                                            echo "<td>";
                                            // echo "<a href='#' title='Edit'><i class='mdi mdi-pencil'></i></a>";
                                            echo "<a href='functionFiles/edit_feature.php?id={$row['id']}' title='Edit'><i class='mdi mdi-pencil'></i></a>";
                                            echo "&nbsp;&nbsp;";
                                            if($row['status'] == 0){
                                                echo "<a href='functionFiles/delete_feature.php?id={$row['id']}' title='Delete' onclick='return confirm(\"Are you sure?\")'><i class='mdi mdi-delete'></i></a>";
                                            }
                                            
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no rows are returned
                                        echo "<tr><td colspan='5'>No properties found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                <!-- Add this div at the end of your HTML body -->



            </div>




        </div>
    </div>



    <?php include "common/footer.php" ?>