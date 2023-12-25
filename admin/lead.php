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
$sql = "SELECT * FROM lead order by id desc";
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
                        <h4 class="card-title">Lead</h4>
                        <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
                        </p>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>mobile</th>
                                        <th>email</th>
                                      
                                        <th>description</th>
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
                                            echo "<td>{$row['lead_name']}</td>";
                                            echo "<td>{$row['lead_mobile']}</td>";
                                            echo "<td>{$row['lead_email']}</td>";
                                            echo "<td>{$row['lead_des']}</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        // If no rows are returned
                                        echo "<tr><td colspan='4'>No properties found</td></tr>";
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