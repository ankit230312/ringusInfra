<?php session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or display an error message
    echo '<script type="text/javascript">window.location.href="index.php";</script>';
    exit();
}

include "dp.php";

include "common/header.php";



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from your table
$sql = "SELECT * FROM propertyland ";
$result = $conn->query($sql);
?>



<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <!-- <h3 class="page-title"> Basic Tables </h3> -->
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>
              </nav> -->
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
                                        <th>propertyId</th>
                                        <th>propertyName</th>
                                        <th>propertyDescription</th>
                                        <th>propertySize</th>
                                        <th>price</th>
                                        <th>propertyStatus</th>
                                        <th>bedrooms</th>
                                        <th>bathrooms</th>
                                        <th>yearBuilt</th>
                                        <th>propertyImage</th>
                                        <th>Status</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if there are rows in the result set
                                    if ($result->num_rows > 0) {
                                        // Loop through each row and populate the table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$row['propertyId']}</td>";
                                            echo "<td>{$row['propertyName']}</td>";
                                            echo "<td>{$row['propertyDescription']}</td>";
                                            echo "<td>{$row['propertySize']}</td>";
                                            echo "<td>{$row['price']}</td>";
                                            echo "<td>{$row['propertyStatus']}</td>";
                                            echo "<td>{$row['bedrooms']}</td>";
                                            echo "<td>{$row['bathrooms']}</td>";
                                            echo "<td>{$row['yearBuilt']}</td>";

                                            // Fetch property images for the current propertyId from propertyimages table
                                            $propertyId = $row['propertyId'];
                                            $imageSql = "SELECT * FROM propertyimages WHERE propertyId = $propertyId";
                                            $imageResult = $conn->query($imageSql);

                                            // Check if there are images for the property
                                            if ($imageResult->num_rows > 0) {
                                                // Inside your PHP loop
                                                // Inside your PHP loop
                                                echo "<td>";
                                                while ($imageRow = $imageResult->fetch_assoc()) {
                                                    $imageSrc = 'propertyImages/' . $imageRow['imageName'];
                                                    echo "<a href='$imageSrc' data-lightbox='propertyImages'><img src='$imageSrc' alt='Property Image' style='max-width: 100px;'></a>";
                                                }
                                                echo "</td>";
                                            } else {
                                                echo "<td>No images</td>";
                                            }

                                            echo "<td>" . ($row['status'] == 0 ? 'Active' : 'Deactivate') . "</td>";

                                            echo "<td>";
                                            // echo "<a href='#' title='Edit'><i class='mdi mdi-pencil'></i></a>";
                                             echo "<a href='functionFiles/edit_property.php?id={$row['propertyId']}' title='Edit'><i class='mdi mdi-pencil'></i></a>";
                                            echo "&nbsp;&nbsp;";
                                            echo "<a href='functionFiles/delete_property.php?id={$row['propertyId']}' title='Delete' onclick='return confirm(\"Are you sure?\")'><i class='mdi mdi-delete'></i></a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no rows are returned
                                        echo "<tr><td colspan='11'>No properties found</td></tr>";
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
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.php -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <!-- <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © com 2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span> -->
        </div>
    </footer>
    <!-- partial -->
</div>


<?php include "common/footer.php" ?>