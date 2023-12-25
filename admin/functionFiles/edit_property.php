<?php session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or display an error message
    echo '<script type="text/javascript">window.location.href="../index.php";</script>';
    exit();
}



include "../dp.php";


// Database connection details


// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted


if (isset($_GET['id'])) {
    $propertyId = $_GET['id'];

    // Fetch data from the database based on propertyId
    $sql = "SELECT * FROM propertyland WHERE propertyId = $propertyId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row_data = $result->fetch_assoc();

        // You can now use $row['columnName'] to get values from the database
    } else {
        // Handle the case where no record is found
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $propertyId = $_GET['id']; // Assuming 'id' is the primary key of your database table

    $propertyName = $_POST['propertyName'];
    $propertySize = $_POST['propertySize'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $price = $_POST['price'];
    $garages = $_POST['garages'];
    $floors = $_POST['floors'];
    $propertyStatus = $_POST['propertyStatus'];
    $propertyDescription = $_POST['propertyDescription'];
    $yearBuilt = $_POST['yearBuilt'];
    $add1 = $_POST['add1'];
    $state = $_POST['state'];
    $add2 = $_POST['add2'];
    $pincode = $_POST['pincode'];
    $city = $_POST['city'];
    $address = $add1 . " " . $add2;

    // Update data in the database
    $sql = "UPDATE propertyland SET 
            propertyName = '$propertyName',
            propertySize = '$propertySize',
            bedrooms = '$bedrooms',
            bathrooms = '$bathrooms',
            price = '$price',
            garages = '$garages',
            floors = '$floors',
            propertyStatus = '$propertyStatus',
            propertyDescription = '$propertyDescription',
            yearBuilt = '$yearBuilt',
         
            state = '$state',
            address = '$address',
            postcode = '$pincode',
            city = '$city'
            WHERE propertyId = $propertyId";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";

        if (!empty($_FILES['img']['name'][0])) {
            $targetDir = "../propertyImages/";
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
          
            // Loop through each file
            foreach ($_FILES['img']['name'] as $key => $val) {
                // Generate a unique image name with a sequence
                $imageName = $propertyId . "_" . time() . "_" . basename($_FILES['img']['name'][$key]);
                $targetFile = $targetDir . $imageName;
          
                // Check if the file type is allowed
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                if (in_array($fileType, $allowTypes)) {
                    // Upload the file
                    move_uploaded_file($_FILES['img']['tmp_name'][$key], $targetFile);
          
                    // Insert the image information into the database
                    $imageSql = "INSERT INTO propertyimages (propertyId, imageName) VALUES ('$propertyId', '$imageName')";
                    
                    if ($conn->query($imageSql) === TRUE) {
                        echo "Image data inserted successfully";
                        echo '<script type="text/javascript">window.location.href="../propertyList.php";</script>';
                    } else {
                        echo "Error inserting image data: " . $conn->error;
                    }
                } else {
                    echo "Invalid file type.";
                }
            }
          }
      
    } else {
        echo "Error updating record: " . $conn->error;
    }

   
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Include jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Include DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- Add these links to the head section of your HTML -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->

    <!-- <link rel="shortcut icon" href="../assets/images/favicon.png" /> -->
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.php -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="dash.php">Ringus</a>
                <a class="sidebar-brand brand-logo-mini" href="dash.php"></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="../assets/images/faces/face15.jpg" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <!-- <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                  <span>Gold Member</span> -->
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-settings text-primary"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-onepassword  text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-calendar-today text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <!-- <li class="nav-item menu-items">
                    <a class="nav-link" href="dash.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="propertyList.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Prpperty List</span>
                    </a>
                </li>
                </li> -->

            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.php -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="dash.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <li class="nav-item w-100">
                            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                <input type="text" class="form-control" placeholder="Search products">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">



                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="../assets/images/faces/face15.jpg" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Henry Klein</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Settings</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Log out</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0 text-center">Advanced settings</p>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">

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
                                        <h4 class="card-title">Property Edit</h4>
                                        <p class="card-description"> </p>
                                        <form class="form-sample" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Property Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="propertyName" class="form-control" value="<?php echo $row_data['propertyName']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Property Size</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="propertySize" class="form-control" value="<?php echo $row_data['propertySize']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Bedroom</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="bedrooms" class="form-control" value="<?php echo $row_data['bedrooms']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Bathroom</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="bathrooms" class="form-control" value="<?php echo $row_data['bathrooms']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Price</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="price" class="form-control" value="<?php echo $row_data['price']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Garage</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="garages" class="form-control" value="<?php echo $row_data['garages']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Floor</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="floors" class="form-control" value="<?php echo $row_data['floors']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Property Type</label>
                                                        <div class="col-sm-9">


                                                            <select class="form-control" name="propertyStatus">
                                                                <option value="Rent" <?php echo ($row_data['propertyStatus'] == 'Rent') ? 'selected' : ''; ?>>Rent</option>
                                                                <option value="Sell" <?php echo ($row_data['propertyStatus'] == 'Sell') ? 'selected' : ''; ?>>Sell</option>
                                                            </select>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Property Description</label>
                                                        <div class="col-sm-9"><textarea class="form-control" name="propertyDescription" value="" id="" rows=""> <?php echo $row_data['propertyDescription']; ?></textarea></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Year Built</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" type="date" name="yearBuilt" value="<?php echo $row_data['yearBuilt']; ?>" placeholder="dd/mm/yyyy" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="card-description"> Address </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Address 1</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="add1" value="<?php echo $row_data['floors']; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">State</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="state" value="<?php echo $row_data['state']; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Address 2</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="add2" value="<?php echo $row_data['postcode']; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Postcode</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="pincode" class="form-control" value="<?php echo $row_data['postcode']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">City</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" name="city" value="<?php echo $row_data['city']; ?>" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">


                                                        <label class="col-sm-3 col-form-label">property Images</label>
                                                        <div class="col-sm-9"> <input type="file" class="form-control" name="img[]" multiple></div>


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



                    <!-- partial:partials/_footer.php -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © ringusinfra.com 2020<br>

                                Distributed By <a href="https://www.themewagon.com/" target="_blank">Ringus Infra</a>

                            </span>
                            <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span> -->
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../assets/vendors/chart.js/Chart.min.js"></script>
        <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
        <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
        <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/hoverable-collapse.js"></script>
        <script src="../assets/js/misc.js"></script>
        <script src="../assets/js/settings.js"></script>
        <script src="../assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->

        <script src="../assets/js/dashboard.js"></script>

        <script>
            let table = new DataTable('#myTable');
        </script>
        <!-- End custom js for this page -->
</body>

<!-- Mirrored from themewagon.github.io/corona-free-dark-bootstrap-admin-template/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Dec 2023 16:44:11 GMT -->

</html>