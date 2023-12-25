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
if (isset($_POST['submit'])) {
  // Retrieve data from the form
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

  $address = $add1 . "." . $add2;

  // Insert data into the database
  $sql = "INSERT INTO propertyland (propertyName, propertySize, bedrooms, bathrooms, price, garages, floors, propertyStatus, propertyDescription, yearBuilt, address, state, postcode, city)
          VALUES ('$propertyName', '$propertySize', '$bedrooms', '$bathrooms', '$price', '$garages', '$floors', '$propertyStatus', '$propertyDescription', '$yearBuilt', '$address' , '$state', '$pincode', '$city')";

  if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";

    // Retrieve the propertyId of the last inserted record
    $propertyId = $conn->insert_id;

    // Upload property images
    // ...

    // Upload property images
    // ...

    // Upload property images
    if (!empty($_FILES['img']['name'][0])) {
      $targetDir = "propertyImages/";
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
          } else {
            echo "Error inserting image data: " . $conn->error;
          }
        } else {
          echo "Invalid file type.";
        }
      }
    }

    // ...


    // ...

  } else {
    echo "Error inserting data: " . $conn->error;
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
            <h4 class="card-title">Property add</h4>
            <p class="card-description"> </p>
            <form class="form-sample" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Property Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="propertyName" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Property Size</label>
                    <div class="col-sm-9">
                      <input type="text" name="propertySize" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bedroom</label>
                    <div class="col-sm-9">
                      <input type="text" name="bedrooms" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bathroom</label>
                    <div class="col-sm-9">
                      <input type="text" name="bathrooms" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                      <input type="text" name="price" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Garage</label>
                    <div class="col-sm-9">
                      <input type="text" name="garages" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Floor</label>
                    <div class="col-sm-9">
                      <input type="text" name="floors" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Property Type</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="propertyStatus">
                        <option>Rent</option>
                        <option>Sell</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Property Description</label>
                    <div class="col-sm-9"><textarea class="form-control" name="propertyDescription" id="exampleTextarea1" rows=""></textarea></div>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Year Built</label>
                    <div class="col-sm-9">
                      <input class="form-control" type="date" name="yearBuilt" placeholder="dd/mm/yyyy" />
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
                      <input type="text" name="add1" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">State</label>
                    <div class="col-sm-9">
                      <input type="text" name="state" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address 2</label>
                    <div class="col-sm-9">
                      <input type="text" name="add2" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Postcode</label>
        <div class="col-sm-9">
            <select class="form-control" name="pincode">
                <?php
                // Assuming you have a database connection $conn
                include "dp.php";

                // Fetch pincode values from the database
                $pincodeQuery = "SELECT pincode FROM pincode";
                $pincodeResult = mysqli_query($conn, $pincodeQuery);

                // Check if there are pincode values
                if ($pincodeResult) {
                  echo "<option>Select Pin Code</option>";
                    while ($row = mysqli_fetch_assoc($pincodeResult)) {
                        // Output each pincode as an option
                        echo "<option>{$row['pincode']}</option>";
                    }
                } else {
                    // Handle query execution failure
                    echo "Error fetching pincode values: " . mysqli_error($conn);
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </select>
        </div>
    </div>
</div>

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-9">
                      <input type="text" name="city" class="form-control" />
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



  <?php include "common/footer.php"; ?>