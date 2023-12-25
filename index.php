<?php include "common/header.php"; ?>


<!--Slider ends-->


<!-- Property Search area Start -->
<section class="property-query-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="uppercase">Advanced Search</h2>
        <p class="heading_space"> We have Properties in these Areas View a list of Featured Properties.</p>
      </div>
    </div>
    <div class="row">
      <form class="callus" method="POST">
        <div class="col-md-3 col-sm-6">
          <div class="single-query form-group">
            <input type="text" class="keyword-input" name="keyword" placeholder="Keyword (e.g. 'office')">
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="single-query form-group">
            <div class="intro">
              <select name="location">
                <option value="">Location</option>

              </select>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="single-query form-group">
            <div class="intro">
              <select name="postal_code">
                <option value="" class="active">Pincode</option>
                <?php
                $sql = "SELECT * FROM pincode where status='0'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='{$row['pincode']}'>{$row['pincode']}</option>";
                } ?>
                <!-- <option>All areas</option>
                
                <option>The Heights</option> -->
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="single-query form-group">
            <div class="intro">
              <select name="propertyStatusSearch">
                <option value="">Property Status</option>
                <option value="Rent">Rent</option>
                <option value="Sell">Sell</option>

              </select>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="row search-2">
            <div class="col-md-6 col-sm-6">
              <div class="single-query form-group">
                <div class="intro">
                  <select name="propertybedSearch">
                    <option class="active">Min Beds</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="single-query form-group">
                <div class="intro">
                  <select name="propertybathSearch">
                    <option class="active">Min Baths</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="row">
            <div class="col-sm-6">
              <div class="single-query form-group">
                <input type="text" class="keyword-input" name="propertyminSearch" placeholder="Min Area (sq ft)">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="single-query form-group">
                <input type="text" class="keyword-input" name="propertymaxSearch" placeholder="Max Area (sq ft)">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-8">
              <div class="single-query-slider">
                <label>Price Range:</label>
                <div class="price text-right">
                  <span>$</span>
                  <div class="leftLabel"></div>
                  <span>to $</span>
                  <div class="rightLabel"></div>
                </div>
                <div data-range_min="0" data-range_max="1500000" data-cur_min="0" data-cur_max="1500000" class="nstSlider">
                  <div class="bar"></div>
                  <div class="leftGrip"></div>
                  <div class="rightGrip"></div>
                </div>
              </div>
            </div>
            <div class="col-md-4 text-right form-group">
              <button type="submit" name="searchPro" class="btn-blue border_radius top15">Search</button>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>
</section>
<!-- Property Search area End -->


<!-- Latest Property -->
<section id="property" class="padding index2 bg_light">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        <h2 class="uppercase">PROPERTY LISTINGS</h2>
        <p class="heading_space"> We are proud to present to you some of the best homes, apartments, offices e.g.
          across Australia for affordable prices. </p>
      </div>
    </div>


    <div class="row">

      <?php $propertiesPerPage = 6;
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

      if (isset($_POST['searchPro'])) {
        // Handle search form submission
        // Retrieve form data

        $keyword = mysqli_real_escape_string($conn, $_POST["keyword"]);
        $location = mysqli_real_escape_string($conn, $_POST["location"]);
        $postal_code = mysqli_real_escape_string($conn, $_POST["postal_code"]);
        $propertyStatusSearch = mysqli_real_escape_string($conn, $_POST["propertyStatusSearch"]);
        $minBeds = intval($_POST["propertybedSearch"]);
        $minBaths = intval($_POST["propertybathSearch"]);
        $minArea = intval($_POST["propertyminSearch"]);
        $maxArea = intval($_POST["propertymaxSearch"]);

        // Construct the SQL query for search
        $conditions = [];

        // Add conditions for the search query based on user input
        if (!empty($keyword)) {
          $conditions[] = "(propertyName LIKE '%$keyword%' OR propertyDescription LIKE '%$keyword%')";
        }
        if ($postal_code != "") {
          $conditions[] = "(postcode = '$postal_code')";
        }
        // if ($propertyStatusSearch !== 'All statuses') {
        //     $conditions[] = "(propertyStatus = '$propertyStatusSearch')";
        // }
        if ($minBeds > 0) {
          $conditions[] = "(bedrooms >= $minBeds)";
        }
        if ($minBaths > 0) {
          $conditions[] = "(bathrooms >= $minBaths)";
        }
        if ($minArea > 0 || $maxArea > 0) {
          $conditions[] = "(propertySize >= $minArea AND propertySize <= $maxArea)";
        }

        // Combine conditions with AND
        $searchCondition = implode(' AND ', $conditions);

        // Construct the SQL query for search
        $searchQuery = "SELECT * FROM propertyland";
        if (!empty($searchCondition)) {
          $searchQuery .= " WHERE $searchCondition";
        }

        // Print or log the generated query for debugging
        // echo "Debug: $searchQuery";

        // Execute the search query
        $searchResult = mysqli_query($conn, $searchQuery);

        // Execute the search query
        $searchResult = mysqli_query($conn, $searchQuery);
      } else {
        // Handle regular property listing without search
        // Fetch properties from the database with pagination
        $offset = ($page - 1) * $propertiesPerPage;
        $query = "SELECT * FROM propertyland WHERE status = 0 LIMIT $offset, $propertiesPerPage";
        $searchResult = mysqli_query($conn, $query);
      }

      // Display properties
      while ($row_details = mysqli_fetch_assoc($searchResult)) { ?>
        <div class="col-sm-6 col-md-4">
          <div class="property_item heading_space">
            <div class="property_head text-center">
              <h3 class="captlize">
                 <a href="details.php?id=<?php echo $row_details['propertyId']; ?>"><?php echo $row_details['propertyName']; ?></a>
            </h3>
              <p><?php echo $row_details['address']; ?></p>
            </div>
            <div class="image">
              <a href="property_detail1.php">
                <div id="propertyCarousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php
                    $query = "SELECT * FROM propertyimages WHERE propertyId = {$row_details['propertyId']}";
                    $propertyImagesResult = mysqli_query($conn, $query);

                    $firstImage = true;
                    while ($image = mysqli_fetch_assoc($propertyImagesResult)) {
                      $imagePath = 'admin/propertyImages/' . $image['imageName'];
                      echo '<div class="carousel-item ' . ($firstImage ? 'active' : '') . '">';
                      echo '<a href="details.php?id='. $row_details['propertyId'] .'"> <img src="' . $imagePath . '" alt="Property Image" class="d-block w-100"> </a>';
                      echo '</div>';

                      $firstImage = false;
                    }
                    ?>
                  </div>
                  <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>

                <div class="price clearfix">
                  <span class="tag pull-right"><?php echo $row_details['propertyStatus']; ?></span>
                </div>
              </a>
            </div>

            <div class="proerty_content">
              <div class="property_meta">
                <span><i class="icon-select-an-objecto-tool"></i><?php echo $row_details['propertySize']; ?></span>
                <span><i class="icon-bed"></i><?php echo $row_details['bedrooms']; ?></span>
                <span><i class="icon-safety-shower"></i><?php echo $row_details['bathrooms']; ?></span>
              </div>
              <div class="proerty_text">
                <p><?php echo $row_details['propertyDescription']; ?></p>
              </div>
              <div class="favroute clearfix">
                <p class="pull-md-left">Rs <?php echo $row_details['price']; ?></p>
                <ul class="pull-right">
                  <li><a href="#."><i class="icon-like"></i></a></li>
                  <li><a href="#one" class="share_expender" data-toggle="collapse"><i class="icon-share3"></i></a></li>
                </ul>
              </div>
              <div class="toggle_share collapse" id="one">
                <ul>
                  <li><a href="#." class="facebook"><i class="icon-facebook-1"></i> Facebook</a></li>
                  <li><a href="#." class="twitter"><i class="icon-twitter-1"></i> Twitter</a></li>
                  <li><a href="#." class="vimo"><i class="icon-vimeo3"></i> Vimeo</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>




    </div>


    <div class="row">
      <!-- Pagination code -->
      <div class="col-md-12 text-center">
        <ul class="pager">
          <?php
          // Pagination links
          $query = "SELECT COUNT(*) as total FROM propertyland";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);

          $totalProperties = $row['total'];
          $totalPages = ceil($totalProperties / $propertiesPerPage);

          for ($i = 1; $i <= $totalPages; $i++) {
            // Add a class to the active page
            $activeClass = ($i == $page) ? 'class="active"' : '';

            echo '<li ' . $activeClass . '><a href="?page=' . $i;
            // Add other parameters if they are set in the search form
            if (isset($_POST['searchPro'])) {
              echo '&keyword=' . urlencode($_POST['keyword']) .
                '&location=' . urlencode($_POST['location']) .
                '&postal_code=' . urlencode($_POST['postal_code']) .
                '&propertyStatusSearch=' . urlencode($_POST['propertyStatusSearch']) .
                '&propertybedSearch=' . urlencode($_POST['propertybedSearch']) .
                '&propertybathSearch=' . urlencode($_POST['propertybathSearch']) .
                '&propertyminSearch=' . urlencode($_POST['propertyminSearch']) .
                '&propertymaxSearch=' . urlencode($_POST['propertymaxSearch']) .
                '&searchPro=';
            }
            echo '">' . $i . '</a></li>';
          }

          // Close the database connection
          // mysqli_close($conn);
          ?>
        </ul>
      </div>

    </div>



  </div>
</section>
<!-- Latest Property Ends -->


<!--Featured Property-->
<section id="featured_property" class="padding">
  <div class="container">
    <div class="row">
      <div class="col-sm-10">
        <h2 class="uppercase">Best Deal Propertiess</h2>
        <p class="heading_space"> We are proud to present to you some of the best homes, apartments, offices e.g. across Australia for affordable
          prices.
        </p>
      </div>
    </div>
    <div class="row">
      <div class="three-item owl-carousel">
        <?php

        $query = "SELECT * FROM propertyland where status = 0";
        $result = mysqli_query($conn, $query);

        // Display properties
        while ($row_bestDeals = mysqli_fetch_assoc($result)) { ?>

          <div class="item feature_item">



            <div class="image">


              <?php
              $query = "SELECT * FROM propertyimages WHERE propertyId = {$row_bestDeals['propertyId']}";
              $propertyImagesResult = mysqli_query($conn, $query);

              $firstImage = true;
              while ($image = mysqli_fetch_assoc($propertyImagesResult)) {
                $imagePath = 'admin/propertyImages/' . $image['imageName'];

                echo '<img src="' . $imagePath . '" alt="Property Image" class="d-block w-100">';


                $firstImage = false;
              }
              ?>




              <span class="price default_clr"><?= $row_bestDeals['price'] ?></span>
            </div>
            <div class="proerty_content">
              <div class="proerty_text">
                <h3 class="bottom15"><a href="property_detail1.html"><?= $row_bestDeals['propertyName'] ?></a></h3>
                <p><?= $row_bestDeals['address'] ?></p>
                <!-- <a href="property_detail1.html" class="btn-more">
                <i><img src="images/arrowl.png" alt="arrow"></i>
                <span>More Details</span>
                <i><img src="images/arrowr.png" alt="arrow"></i>
              </a> -->
              </div>
              <div class="property_meta"> <span><i class="icon-select-an-objecto-tool"></i><?= $row_bestDeals['propertySize'] ?></span> <span><i class="icon-bed"></i><?= $row_bestDeals['bedrooms'] ?> Office Rooms</span> <span><i class="icon-safety-shower"></i><?= $row_bestDeals['bathrooms'] ?> Bathroom</span> </div>
            </div>
          </div>

        <?php

        }
        ?>

      </div>
    </div>
  </div>
</section>
<!--Featured Property Ends-->


<section id="parallax_four" class="padding">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 bottom30">
        <h2>We Don’t Just Find <br> <span class="t_yellow">Great Deals</span> We Create Them</h2>
        <h4 class="top20">We are proud to present to you some of the best homes, apartments, offices e.g.
          across Australia for affordable prices.</h4>
        <a href="listing4.php" class="text-uppercase btn-white top20">view all listings</a>

      </div>
    </div>
  </div>
</section>

<!--Testinomials-->
<section id="agent" class="padding">

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="uppercase">Comming Soon Projects</h2>
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec viverra erat Aenean elit tellus.</p> -->
      </div>
    </div>
    <div class="row">
      <?php
      $sql = "SELECT * FROM upcomingproject WHERE status = '0'";
      $result_comming = $conn->query($sql);
      if ($result_comming->num_rows > 0) {
        // Loop through each row and display the project information
        while ($row_comming = $result_comming->fetch_assoc()) {
      ?>

          <div class="col-sm-4 text-center">
            <div class="agent_wrap margin40">
              <div class="image">
                <img src="admin/<?php echo $row_comming['projectImage'] ?>" alt="Agents">
                <div class="overlay">
                  <div class="centered text-center">
                    <ul class="social_share">
                      <li><a href="#." class="facebook"><i class="icon-facebook-1"></i></a></li>
                      <li><a href="#." class="twitter"><i class="icon-twitter-1"></i></a></li>
                      <li><a href="#." class="google"><i class="icon-google4"></i></a></li>
                      <li><a href="#." class="linkden"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="agent_text">
                <h3><?php echo $row_comming['projectName'] ?></h3>
                <!-- <p>sales executive</p> -->
                <p class="bottom20"><?php echo $row_comming['projectName'] ?></p>
                <a class="btn-more" target="_blank" href="<?php echo $row_comming['projectUrl'] ?>">
                  <i><img alt="arrow" src="images/arrowlY.png"></i><span>Visit</span><i><img alt="arrow" src="images/arrowrY.png"></i>
                </a>
              </div>
            </div>
          </div>
      <?php }
      } ?>


    </div>
  </div>
</section>
<!--Testinomials ends-->


<!--Parallax-->

<!--About Owner ends-->

<!--Partners-->
<section id="logos">
  <div class="container partner2 padding">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2 class="uppercase">Our Partners</h2>
        <p class="heading_space">Aliquam nec viverra erat. Aenean elit tellus mattis quis maximus.</p>
      </div>
    </div>
    <div class="row">
      <div id="partners" class="owl-carousel owl-theme">
        <div class="item">
          <img src="images/logo1.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo2.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo3.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo4.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo5.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo1.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo2.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo3.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo4.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo5.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo1.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo2.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo3.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo4.png" alt="Featured Partner">
        </div>
        <div class="item">
          <img src="images/logo5.png" alt="Featured Partner">
        </div>
      </div>
    </div>
  </div>
</section>
<!--Partners Ends-->


<?php include "common/footer.php"; ?>