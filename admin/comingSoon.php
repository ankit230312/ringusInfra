<?php session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or display an error message
    echo '<script type="text/javascript">window.location.href="index.php";</script>';
    exit();
}

include "common/header.php";

include "dp.php";


// Database connection details


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Check if the form is submitted
if(isset($_POST['submit'])){
    // Get form data
    $projectName = $_POST['projectName'];
    $projectDescription = $_POST['projectdesc'];
    $projectUrl = $_POST['projectUrl'];

    // Upload project image
    $target_dir = "projectImage/"; // specify your target directory
    $target_file = $target_dir . basename($_FILES["projectImage"]["name"]);
    move_uploaded_file($_FILES["projectImage"]["tmp_name"], $target_file);

    // Insert data into the database
    $sql = "INSERT INTO upcomingproject (projectName, projectDescription, projectUrl, projectImage) VALUES ('$projectName', '$projectDescription', '$projectUrl', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>


<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"></a></li>
                    <li class="breadcrumb-item active" aria-current="page"></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col"></div>

            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Project</h4>
                        <p class="card-description"> </p>
                        <form class="form-sample" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Project Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="projectName" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Project Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="projectdesc" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Project Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="projectImage" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Project Url</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="projectUrl" class="form-control" />
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
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->



    <?php include "common/footer.php"; ?>