
<?php include "common/header.php";

$propertId = $_GET['id'];

$query = "SELECT * FROM propertyland WHERE propertyId = $propertId AND status = 0 ";
$propertyDetails = mysqli_query($conn, $query);
$row_details = mysqli_fetch_assoc($propertyDetails);
// Check if the query was successful

// Close the database connection

$query_fea = "SELECT * FROM features WHERE property_id = $propertId AND status = 0 ";
$propertyfeature = mysqli_query($conn, $query_fea);



?>




<!-- Page Banner Start-->
<section class="page-banner padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1 class="text-uppercase"><?php echo $row_details['propertyName'] ?></h1>
        <!-- <p>Serving you since 1999. Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
        <ol class="breadcrumb text-center">
          <li><a href="#.">Home</a></li>
          <li><a href="#.">Properties</a></li>
          <li class="active">Property Details - 1</li>
        </ol> -->
      </div>
    </div>
  </div>
</section>
<!-- Page Banner End -->


<!-- Property Detail Start -->
<section id="property" class="padding_top padding_bottom_half">
  <div class="container">
    <div class="row">
      <div class="col-md-8 listing1 property-details">
        <h2 class="text-uppercase"><?php echo $row_details['propertyName'] ?></h2>
        <p class="bottom30"><?php echo $row_details['address'] ?></p>
        <div id="property-d-1" class="owl-carousel">
          <div class="item"><img src="images/property-details/property-d-1-1.jpg" alt="image" /></div>
        
        </div>
      
        <div class="property_meta bg-black bottom40">
          <span><i class="icon-select-an-objecto-tool"></i><?php echo $row_details['propertySize'] ?></span>
          <!-- <span><i class=" icon-microphone"></i>2 Office Rooms</span> -->
          <span><i class="icon-safety-shower"></i><?php echo $row_details['bedrooms'] ?> Bathroom</span>
          <!-- <span><i class="icon-old-television"></i>TV Lounge</span> -->
          <span><i class="icon-garage"></i><?php echo $row_details['garages'] ?> Garage</span>
        </div>
        <h2 class="text-uppercase">Property Description</h2>
        <p class="bottom30"><?php echo $row_details['propertyDescription'] ?></p>
        <!-- <p class="bottom30">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis et metus in libero sollicitudin venenatis eu sed enim. Nam felis lorem, suscipit ac nisl ac, iaculis dapibus tellus. Cras ante justo, aliquet quis placerat nec, molestie id turpis. </p> -->

        <h2 class="text-uppercase bottom20">Quick Summary</h2>
        <div class="row property-d-table bottom40">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <table class="table table-striped table-responsive">
              <tbody>
                <tr>
                  <td><b>Property Id</b></td>
                  <td class="text-right"><?php echo $row_details['propertyId'] ?></td>
                </tr>
                <tr>
                  <td><b>Price</b></td>
                  <?php



                  ?>
                  <td class="text-right"><?php echo ($row_details['propertyStatus'] == "Rent") ? $row_details['price'] . "" . "/ Month" : $row_details['price']  ?></td>
                </tr>
                <tr>
                  <td><b>Property Size</b></td>
                  <td class="text-right"><?php echo $row_details['propertySize'] ?></td>
                </tr>
                <tr>
                  <td><b>Bedrooms</b></td>
                  <td class="text-right"><?php echo $row_details['bedrooms'] ?></td>
                </tr>
                <tr>
                  <td><b>Bathrooms</b></td>
                  <td class="text-right"><?php echo $row_details['bathrooms'] ?></td>
                </tr>
                <tr>
                  <td><b>Available From</b></td>
                  <td class="text-right">22-04-2017</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <table class="table table-striped table-responsive">
              <tbody>
                <tr>
                  <td><b>Status</b></td>
                  <td class="text-right">Rent</td>
                </tr>
                <tr>
                  <td><b>Year Built</b></td>
                  <td class="text-right">1991</td>
                </tr>
                <tr>
                  <td><b>Garages</b></td>
                  <td class="text-right">1</td>
                </tr>
                <tr>
                  <td><b>Cross Streets</b></td>
                  <td class="text-right">Nordoff</td>
                </tr>
                <tr>
                  <td><b>Floors</b></td>
                  <td class="text-right">Carpet - Ceramic Tile</td>
                </tr>
                <tr>
                  <td><b>Plumbing</b></td>
                  <td class="text-right">Full Copper Plumbing</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <h2 class="text-uppercase bottom20">Features</h2>
        <div class="row bottom40">
        <?php while ($row = mysqli_fetch_assoc($propertyfeature)) {
        $featureName = $row['features'];
          ?>
              <div class="col-md-4 col-sm-6 col-xs-12">
                  <ul class="pro-list">
                      <li><?php echo $featureName; ?></li>
                  </ul>
              </div>
          <?php
          }
          ?>
          
        </div>
       
   
        <h2 class="text-uppercase bottom20">Video Presentation</h2>
        <div class="row bottom40">
          <div class="col-md-12 padding-b-20">
            <div class="pro-video">
              <figure class="wpf-demo-gallery">
                <video class="video" controls>
                  <source src="video/video.mp4" type="video/mp4">
                  <source src="video/video.html" type="video/ogg">
                </video>
              </figure>
            </div>
          </div>
        </div>
        <h2 class="text-uppercase bottom20">Property Map</h2>
        <div class="row bottom40">
          <div class="col-md-12 bottom20">
            <div class="property-list-map">
              <div id="property-listing-map" class="multiple-location-map" style="width:100%;height:430px;"></div>
            </div>
          </div>
          <div class="social-networks">
            <div class="social-icons-2">
              <span class="share-it">Share this Property</span>
              <span><a href="#."><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></span>
              <span><a href="#."><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></span>
              <span><a href="#."><i class="fa fa-google-plus" aria-hidden="true"></i> Google +</a></span>
            </div>
          </div>
        </div>
        <h2 class="text-uppercase bottom20">Contact Agent</h2>
        <div class="row">
          <div class="col-sm-6 bottom40">
            <div class="agent_wrap">
              <div class="image">
                <img src="images/agent-one.jpg" alt="Agents">
              </div>
            </div>
          </div>
          <div class="col-sm-6 bottom40">
            <div class="agent_wrap">
              <h3>Bohdan Kononets</h3>
              <p class="bottom30">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh tempor cum soluta nobis consectetuer adipiscing eleifend option congue nihil imperdiet doming…</p>
              <table class="agent_contact table">
                <tbody>
                  <tr class="bottom10">
                    <td><strong>Phone:</strong></td>
                    <td class="text-right">(+01) 34 56 7890</td>
                  </tr>
                  <tr class="bottom10">
                    <td><strong>Mobile:</strong></td>
                    <td class="text-right">(+033) 34 56 7890</td>
                  </tr>
                  <tr>
                    <td><strong>Email Adress:</strong></td>
                    <td class="text-right"><a href="#.">bohdan@castle.com</a></td>
                  </tr>
                  <tr>
                    <td><strong>Skype:</strong></td>
                    <td class="text-right"><a href="#.">bohdan.kononets</a></td>
                  </tr>
                </tbody>
              </table>
              <div style="border-bottom:1px solid #d3d8dd;" class="bottom15"></div>
              <ul class="social_share">
                <li><a href="#." class="facebook"><i class="icon-facebook-1"></i></a></li>
                <li><a href="#." class="twitter"><i class="icon-twitter-1"></i></a></li>
                <li><a href="#." class="google"><i class="icon-google4"></i></a></li>
                <li><a href="#." class="linkden"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#." class="vimo"><i class="icon-vimeo3"></i></a></li>
              </ul>
            </div>
          </div>

        </div>
        <div class="col-sm-12 bottom40">
          <form class="callus">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <textarea class="form-control" placeholder="Message"></textarea>
                </div>
              </div>
              <div class="col-sm-12 row">
                <div class="row">
                  <div class="col-sm-3">
                    <input type="submit" class="btn-blue uppercase border_radius" value="submit now">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

 
    
      </div>
      <!-- <aside class="col-md-4 col-xs-12">
        <div class="property-query-area clearfix">
          <div class="col-md-12">
            <h3 class="text-uppercase bottom20 top15">Advanced Search</h3>
          </div>
          <form class="callus">
            <div class="single-query form-group col-sm-12">
              <input type="text" class="keyword-input" placeholder="Keyword (e.g. 'office')">
            </div>
            <div class="single-query form-group col-sm-12">
              <div class="intro">
                <select>
                  <option selected="" value="any">Location</option>
                  <option>All areas</option>
                  <option>Bayonne </option>
                  <option>Greenville</option>
                  <option>Manhattan</option>
                  <option>Queens</option>
                  <option>The Heights</option>
                </select>
              </div>
            </div>
            <div class="single-query form-group col-sm-12">
              <div class="intro">
                <select>
                  <option class="active">Property Type</option>
                  <option>All areas</option>
                  <option>Bayonne </option>
                  <option>Greenville</option>
                  <option>Manhattan</option>
                  <option>Queens</option>
                  <option>The Heights</option>
                </select>
              </div>
            </div>
            <div class="single-query form-group col-sm-12">
              <div class="intro">
                <select>
                  <option class="active">Property Status</option>
                  <option>All areas</option>
                  <option>Bayonne </option>
                  <option>Greenville</option>
                  <option>Manhattan</option>
                  <option>Queens</option>
                  <option>The Heights</option>
                </select>
              </div>
            </div>
            <div class="search-2 col-sm-12">
              <div class="row">
                <div class="col-sm-6">
                  <div class="single-query form-group">
                    <div class="intro">
                      <select>
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
                <div class="col-sm-6">
                  <div class="single-query form-group">
                    <div class="intro">
                      <select>
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
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-6">
                  <div class="single-query form-group">
                    <input type="text" class="keyword-input" placeholder="Min Area (sq ft)">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="single-query form-group">
                    <input type="text" class="keyword-input" placeholder="Max Area (sq ft)">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 bottom10">
              <div class="single-query-slider">
                <label><strong>Price Range:</strong></label>
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
            <div class="col-sm-12 form-group">
              <button type="submit" class="btn-blue border_radius">Search</button>
            </div>
          </form>
          <div class="col-sm-12">
            <div class="group-button-search">
              <a data-toggle="collapse" href=".html" class="more-filter bottom15">
                <i class="fa fa-plus text-1" aria-hidden="true"></i><i class="fa fa-minus text-2 hide" aria-hidden="true"></i>
                <div class="text-1">Show more search options</div>
                <div class="text-2 hide">less more search options</div>
              </a>
            </div>
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
        <div class="row">
          <div class="col-md-12">
            <h3 class="bottom40 margin40">Featured Properties</h3>
          </div>
        </div>
        <div class="row bottom20">
          <div class="col-md-4 col-sm-4 col-xs-6 p-image">
            <img src="images/f-p-1.png" alt="image"/>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-6">
            <div class="feature-p-text">
              <h4>Historic Town House</h4>
              <p class="bottom15">45 Regent Street, London, UK</p>
              <a href="#.">$128,600</a>
            </div>
          </div>
        </div>
        <div class="row bottom20">
          <div class="col-md-4 col-sm-4 col-xs-6 p-image">
            <img src="images/f-p-1.png" alt="image"/>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-6">
            <div class="feature-p-text">
              <h4>Historic Town House</h4>
              <p class="bottom15">45 Regent Street, London, UK</p>
              <a href="#.">$128,600</a>
            </div>
          </div>
        </div>
        <div class="row bottom20">
          <div class="col-md-4 col-sm-4 col-xs-6 p-image">
            <img src="images/f-p-1.png" alt="image"/>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-6">
            <div class="feature-p-text">
              <h4>Historic Town House</h4>
              <p class="bottom15">45 Regent Street, London, UK</p>
              <a href="#.">$128,600</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <h3 class="margin40 bottom20">Featured Properties</h3>
          </div>
          <div class="col-md-12">
            <div id="agent-2-slider" class="owl-carousel">
              <div class="item">
                <div class="property_item heading_space">
                  <div class="image">
                    <a href="#."><img src="images/slider-list2.jpg" alt="listin" class="img-responsive"></a>
                    <div class="feature"><span class="tag-2">For Rent</span></div>
                    <div class="price clearfix"><span class="tag pull-right">$8,600 Per Month - <small>Family Home</small></span></div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="property_item heading_space">
                  <div class="image">
                    <a href="#."><img src="images/slider-list2.jpg" alt="listin" class="img-responsive"></a>
                    <div class="feature"><span class="tag-2">For Rent</span></div>
                    <div class="price clearfix"><span class="tag pull-right">$8,600 Per Month - <small>Family Home</small></span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside> -->
    </div>
  </div>
</section>
<!-- Property Detail End -->









<?php include "common/footer.php"; ?>