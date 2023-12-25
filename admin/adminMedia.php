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

$insertData = true;

// Check if the form is submitted
if (isset($_POST['mediaSubmit'])) {
    // Get form data
    $mediaTitle = $_POST['mediaTitle'];
    $mediaShortDesc = $_POST['mediaShortDesc'];
    $mediaLongDesc = $_POST['mediaLongDesc'];

    // File upload handling
    $targetDir = "mediaImage/";
    $targetFile = $targetDir . basename($_FILES["mediaImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["mediaImage"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File is not an image.');</script>";
        $insertData = false;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "<script>alert('Sorry, file already exists.');</script>";
        $insertData = false;
    }

    // Check file size
    if ($_FILES["mediaImage"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $insertData = false;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $insertData = false;
    }

    // If everything is okay, try to upload file
    if ($insertData && !move_uploaded_file($_FILES["mediaImage"]["tmp_name"], $targetFile)) {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        $insertData = false;
    }

    // If all validations passed, insert data into the database
    if ($insertData) {
        $sql = "INSERT INTO media (mediaTitle, mediaShortDesc, mediaLongDesc, mediaImage) VALUES ('$mediaTitle', '$mediaShortDesc', '$mediaLongDesc', '$targetFile')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
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
                        <h4 class="card-title">Media</h4>
                        <p class="card-description"> </p>
                        <form class="form-sample" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Media Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mediaTitle" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Media Short Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mediaShortDesc" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Long Description</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="mediaLongDesc" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">


                                        <label class="col-sm-3 col-form-label">Media Images</label>
                                        <div class="col-sm-9"> <input type="file" class="form-control" name="mediaImage" ></div>


                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="mediaSubmit" class="btn btn-primary mr-2">Submit</button>
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