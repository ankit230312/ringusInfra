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
$sql = "SELECT * FROM upcomingproject ";
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
                        <h4 class="card-title">Project List</h4>
                        <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
                        </p>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Project Id</th>
                                        <th>project Name</th>
                                        <th>project Description</th>
                                        <th>property Image</th>
                                        <th>property Url</th>

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
                                            echo "<td>{$row['id']}</td>";
                                            echo "<td>{$row['projectName']}</td>";
                                            echo "<td>{$row['projectDescription']}</td>";
                                            echo "<td><img src='{$row['projectImage']}' alt='Project Image' style='max-width: 100px; max-height: 100px;'></td>";
                                            echo "<td>{$row['projectUrl']}</td>";

                                            echo "<td>" . ($row['status'] == 0 ? 'Active' : 'Deactivate') . "</td>";
                                            // Add more columns if needed
                                            echo "<td>";
                                            // echo "<a href='#' title='Edit'><i class='mdi mdi-pencil'></i></a>";
                                            echo "<a href='functionFiles/edit_project.php?id={$row['id']}' title='Edit'><i class='mdi mdi-pencil'></i></a>";
                                            echo "&nbsp;&nbsp;";
                                            echo "<a href='functionFiles/delete_project.php?id={$row['id']}' title='Delete' onclick='return confirm(\"Are you sure?\")'><i class='mdi mdi-delete'></i></a>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no rows are returned
                                        echo "<tr><td colspan='7'>No projects found</td></tr>";
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