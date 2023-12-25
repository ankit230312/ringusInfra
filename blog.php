<?php include "common/header.php" ?>


<!-- Page Banner Start-->
<section class="page-banner padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1 class="text-uppercase">Blog</h1>
        <!-- <p>Serving you since 1999. Lorem ipsum dolor sit amet consectetur adipiscing elit.</p> -->
        <!-- <ol class="breadcrumb text-center">
          <li><a href="#">Home</a></li>
          <li><a href="#">Pages</a></li>
          <li><a href="#">Listing</a></li>
          <li class="active">Listing - 1</li>
        </ol> -->
      </div>
    </div>
  </div>
</section>
<!-- Page Banner End -->



<!-- Listing Start -->
<section id="listing1" class="listing1 padding_top">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-md-9">
            <h2 class="uppercase">Our Blogs</h2>
            <!-- <p class="heading_space">We have Properties in these Areas View a list of Featured Properties.</p> -->
          </div>
          <div class="col-md-3">

          </div>
        </div>
        <?php $propertiesPerPage = 6;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        if (isset($_GET['blog_category'])) {
          // Handle search form submission
          // Retrieve form data

          $keyword = mysqli_real_escape_string($conn, $_GET["blog_category"]);

          // Construct the SQL query for search
          $conditions = "";

          // Add conditions for the search query based on user input
          if (!empty($keyword) && $keyword != "") {
            $conditions .= " blog_category='$keyword'";
          }

          $searchQuery = "SELECT * FROM blog";
          if (!empty($conditions)) {
            $searchQuery .= " WHERE $conditions";
          }

          // Print or log the generated query for debugging
          #echo "Debug: $searchQuery";die;

          // Execute the search query
          $searchResult = mysqli_query($conn, $searchQuery);

          // Execute the search query
          $searchResult = mysqli_query($conn, $searchQuery);
        } else {

          $offset = ($page - 1) * $propertiesPerPage;
          $query = "SELECT * FROM blog WHERE status = 1 LIMIT $offset, $propertiesPerPage";
          $searchResult = mysqli_query($conn, $query);
        } ?>
        <div class="row">
          <?php while ($row_details = mysqli_fetch_assoc($searchResult)) { ?>
            <div class="col-sm-6">
              <div class="property_item heading_space">
                <div class="image">
                  <a href="#."><img src="images/listing1.jpg" alt="latest property" class="img-responsive"></a>
                  <div class="price clearfix">
                    <!-- <span class="tag pull-right">$8,600 Per Month</span> -->
                  </div>
                  <!-- <span class="tag_t">For Sale</span> 
                <span class="tag_l">Featured</span> -->
                </div>
                <div class="proerty_content">
                  <div class="proerty_text">
                    <h3 class="captlize"><a href="blog_detail.php?id=<?php echo $row_details['id']; ?>"><?php echo $row_details['name']; ?></a></h3>
                    <p><?php echo substr($row_details['desc'], 0, 50) . '...'; ?></p>
                  </div>
                  <div class="property_meta transparent">
                   
                  </div>
                  <div class="property_meta transparent bottom30">
                 
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

        <div class="padding_bottom text-center">
          <ul class="pager">
            <?php
            // Pagination links
            $query = "SELECT COUNT(*) as total FROM blog";
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
                echo '&keyword=' . urlencode($_POST['blog_category']) .
                  '&searchPro=';
              }
              echo '">' . $i . '</a></li>';
            }

            ?>
          </ul>
        </div>
      </div>
      <aside class="col-md-4 col-xs-12">
        <div class="property-query-area clearfix">
          <div class="col-md-12">
            <h3 class="text-uppercase bottom20 top15">Advanced Search</h3>
          </div>
          <form class="callus">
            <div class="single-query form-group col-sm-12">
              <div class="intro">
                <select name="blog_category" id="blog_category" class="form-control">
                  <option value="">Select</option>
                  <?php $sql = "SELECT * FROM blog_category where status ='1'";
                  $result = $conn->query($sql);

                  while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $_GET['blog_category']) ? 'selected' : '';
                    echo "<option value='{$row['id']}' {$selected}>{$row['category']}</option>";
                  } ?>
                </select>
              </div>
            </div>


            <div class="col-sm-12 form-group">
              <button type="submit" class="btn-blue border_radius">Search</button>
            </div>
          </form>
          <div class="col-sm-12">

          </div>
          <div class="search-propertie-filters collapse">
            <div class="container-2">
              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="search-form-group white">
                    <input type="checkbox" name="check-box" />
                    <span>Rap music</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </aside>
    </div>
  </div>
</section>


<?php include "common/footer.php" ?>