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
    $sql = "SELECT * FROM blog WHERE id = $propertyId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row_data = $result->fetch_assoc();

        // You can now use $row['columnName'] to get values from the database
    } else {
        // Handle the case where no record is found
    }
}

if (isset($_POST['submit'])) {
    // Get form data
    $blog_cat = $_POST['blog_category'];
    $name = $_POST['name'];
    $blog_desc = $_POST['desc'];

    // Check if a file is selected
    if ($_FILES["image"]["size"] > 0) {
        $target_dir = "blogImage/"; // specify your target directory
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Update data with project image
        $sql = "UPDATE blog SET blog_category='$blog_cat', name='$name', `desc`='$blog_desc', image='$target_file' WHERE id = $propertyId";
    } else {
        // Update data without changing project image
        $sql = "UPDATE blog SET blog_category='$blog_cat', name='$name', `desc`='$blog_desc' WHERE id = $propertyId";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../blog_list.php");
        echo "Record updated successfully";
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
                                        <h4 class="card-title">Blog Edit</h4>
                                        <p class="card-description"> </p>
                                        <form class="form-sample" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Blog Category </label>
                                                    <div class="col-sm-9">
                                                        <!-- <input type="text" name="feature" class="form-control" required /> -->
                                                        <select name="blog_category" id="blog_category" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <?php $sql = "SELECT * FROM blog_category where status='1'";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc())
                                                            {
                                                                $selected = ($row['id'] == $row_data['blog_category']) ? 'selected' : '';
                                                                echo "<option value='{$row['id']}'  {$selected}>{$row['category']}</option>";
                                                            }?>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Blog Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" class="form-control" value="<?php echo $row_data['name'] ; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Blog Description</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="desc" id="desc" class="form-control" rows="3" required="required"><?php echo $row_data['desc'] ; ?></textarea>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Blog Image</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="image" class="form-control" required />
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    

                                        <button type="submit" name="submit" class="btn btn-primary mr-2">Update</button>
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