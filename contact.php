<?php include "admin/dp.php";

	#	Name	Type	Collation	Attributes	Null	Default	Comments	Extra	Action
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $lead_name = mysqli_real_escape_string($conn, $_POST['lead_name']);
    $lead_mobile = mysqli_real_escape_string($conn, $_POST['lead_mobile']);
    $lead_email = mysqli_real_escape_string($conn, $_POST['lead_email']);
    $lead_des = mysqli_real_escape_string($conn, $_POST['lead_des']);

    // Insert data into the database
    $sql = "INSERT INTO lead (lead_name, lead_mobile ,lead_email, lead_des) VALUES ('$lead_name','$lead_mobile' , '$lead_email', '$lead_des')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('We will continue you soon');
        window.location.href = 'index.php' 
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
// $conn->close();


?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wahabali.com/work/castle/index8.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Jul 2022 08:47:45 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Ringus Infra</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/reality-icon.css">
<link rel="stylesheet" type="text/css" href="css/bootsnav.css">
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
<!-- <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/owl.transitions.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" type="text/css" href="css/cubeportfolio.min.css">
<link rel="stylesheet" type="text/css" href="css/settings.css">
<link rel="stylesheet" type="text/css" href="css/range-Slider.min.css">
<link rel="stylesheet" type="text/css" href="css/search.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="image/x-icon" href="images/favIcon.png">
</head>
<body>


<!--Loader-->
<div class="loader">
  <div class="span">
    <div class="location_indicator"></div>
  </div>
</div>
 <!--Loader--> 
 
 


<header class="layout_double">

  <div class="header-upper dark">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <div class="logo">
          <a href="index.php"><img alt="" width="150px" src="images/2.png" class="img-responsive"></a>
          </div>
        </div>
      <!--Info Box-->
        <div class="col-md-9 col-sm-12 right">
          <div class="info-box first">
            <div class="icons"><i class="icon-telephone114"></i></div>
            <ul>
              <li><strong>Phone Number</strong></li>
              <li>+91 9355176143</li>
            </ul>
          </div>
          <div class="info-box">
          <div class="icons"><i class="icon-icons74"></i></div>
          <ul>
            <li><strong>Ringus Infra, Noida One Tower B</strong></li>
            <li>Sector 62 , Noida 201309</li>
          </ul>
        </div>
          <div class="info-box">
            <div class="icons"><i class="icon-icons142"></i></div>
            <ul>
              <li><strong>Email Address</strong></li>
              <li><a href="#.">info@ringusinfra.com</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>
  <nav class="navbar navbar-default navbar-sticky bootsnav">
    <div class="container">
          <div class="attr-nav">
            <ul class="social_share clearfix">
            <li><a href="#." class="facebook"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#." class="twitter"><i class="fa fa-twitter"></i></a></li>
            <li><a class="google" href="#."><i class="icon-google4"></i></a></li>
            </ul>
          </div> 
            
        <!-- Start Header Navigation -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand sticky_logo" href="index.php"><img width="150px"  src="images/2.png" class="logo" alt=""></a>
        </div><!-- End Header Navigation -->
          <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="nav navbar-nav" data-in="fadeIn" data-out="fadeOut">
              <li class=" active">
                <a href="index.php" class="dropdown-toggle" data-toggle="dropdown">Home </a>
               
              </li>
              <li class=" ">
                <a href="about.php" class="dropdown-toggle" data-toggle="dropdown">About us</a>
              
              </li>
              <li class=" dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Project</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Residential</a></li>
                  <li><a href="#">Commercial</a></li>
                 
                </ul>
              </li>
              <li class=" ">
                <a href="media.php" class="dropdown-toggle" data-toggle="dropdown">Media</a>
              
              </li>
              <li class=" ">
                <a href="blog.php" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
              
                
              </li>
              <li class=" ">
                <a href="contact.php" class="dropdown-toggle" data-toggle="dropdown">Customer Support</a>
              
              </li>
              <!-- <li class=" ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
              
              </li> -->
              <!-- <li class="dropdown megamenu-fw">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Properties</a>
                <ul class="dropdown-menu megamenu-content bg" role="menu">
                  <li>
                    <div class="row">
                      <div class="col-menu col-md-3">
                        <h5 class="title">PROPERTY LISTINGS</h5>
                        <div class="content">
                          <ul class="menu-col">
                            <li><a href="listing1.php">List Style 1</a></li>
                            <li><a href="listing2.php">List Style 2</a></li>
                            <li><a href="listing3.php">List Style 3</a></li>
                            <li><a href="listing4.php">List Style 4</a></li>
                            <li><a href="listing5.php">List Style 5</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-menu col-md-3">
                        <h5 class="title">PROPERTY LISTINGS</h5>
                        <div class="content">
                          <ul class="menu-col">
                            <li><a href="listing6.php">List Style 5</a></li>
                            <li><a href="listing7.php">List Style 6</a></li>
                            <li><a href="listing1.php">Search by City</a></li>
                            <li><a href="listing2.php">Search by Category</a></li>
                            <li><a href="listing3.php">Search by Type</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-menu col-md-3">
                        <h5 class="title">PROPERTY DETAIL</h5>
                        <div class="content">
                          <ul class="menu-col">
                            <li><a href="property_detail1.php">Property Detail 1</a></li>
                            <li><a href="property_detail2.php">Property Detail 2</a></li>
                            <li><a href="property_detail3.php">Property Detail 3</a></li>
                            <li><a href="index7.php">Single Property</a></li>
                            <li><a href="listing4.php">Search by Type</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-menu col-md-3">
                        <h5 class="title">OTHER PAGES</h5>
                        <div class="content">
                          <ul class="menu-col">
                            <li><a href="favorite_properties.php">Favorite Properties</a></li>
                            <li><a href="agent_profile.php">Agent Profile</a></li>
                            <li><a href="404.php">404 Error</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                            <li><a href="testimonial.php">Testimonials</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
               -->
              <li><a href="#">Book site visit</a></li>
            
            </ul>
        </div>
        </div>
  </nav>
</header>

    <!--Header Ends-->

    <!--Contact-->
    <section id="contact-us">
      <div class="contact">
        <div id="map1">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.2295645164136!2d77.3636935752254!3d28.622881084519367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce54527facb9d%3A0x97ffe7a242924504!2sTOWER-B%2C%20Noida%20One%2C%20Rasoolpur%20Nawada%2C%20Industrial%20Area%2C%20Sector%2062%2C%20Greater%20Noida%2C%20Noida%2C%20Uttar%20Pradesh%20201309!5e0!3m2!1sen!2sin!4v1701710083083!5m2!1sen!2sin" width="100%" height="1010px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-4 hidden-xs"></div>

            <div class="col-md-4 hidden-xs"></div>

            <div class="col-md-4 col-sm-4 col-xs-12 contact-text">
              <div class="agent-p-contact">
                <div class="our-agent-box bottom30">
                  <h2>get in touch</h2>
                </div>
                <div class="agetn-contact-2 bottom30">
                  <p><i class="icon-telephone114"></i> +91 9355176143</p>
                  <p><i class="icon-icons142"></i> info@ringusinfra.com</p>

                 
                </div>
                <ul class="social_share bottom20">
                  <li>
                    <a href="javascript:void(0)" class="facebook"
                      ><i class="icon-facebook-1"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="twitter"
                      ><i class="icon-twitter-1"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="google"
                      ><i class="icon-google4"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="linkden"
                      ><i class="fa fa-linkedin"></i
                    ></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="vimo"
                      ><i class="icon-vimeo3"></i
                    ></a>
                  </li>
                </ul>
              </div>

              <div class="agent-p-form">
                <div class="our-agent-box bottom30">
                  <h2>Send us a message</h2>
                </div>

                <div class="row">
                  <form action="#" class="callus " method="post">
                    <div class="col-md-12">
                      <div class="single-query form-group">
                        <input
                          type="text"
                          placeholder="Your Name" name="lead_name"
                          class="keyword-input"
                        />
                      </div>
                      <div class="single-query form-group">
                        <input
                          type="text"
                          placeholder="Phone Number" name="lead_mobile"
                          class="keyword-input"
                        />
                      </div>
                      <div class="single-query form-group">
                        <input
                          type="text"
                          placeholder="Email Adress" name="lead_email"
                          class="keyword-input"
                        />
                      </div>
                      <div class="single-query form-group">
                        <textarea
                          placeholder="Massege"
                          class="form-control" name="lead_des"
                        ></textarea>
                      </div>
                      <input
                        type="submit"
                        value="submit now" 
                        class="btn-blue"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact End -->

    <!--Footer-->
    <!--Footer-->
<footer class="padding_top footer2">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <div class="footer_panel bottom30">
          <a href="#." class="logo bottom30"><img src="images/1.png" width=" 249px" alt="logo"></a>
          <p class="bottom15">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
            tempor cum consectetuer
            adipiscing.</p>
          <!-- <p class="bottom15">If you are interested in castle do not wait and <a href="#.">BUY IT NOW!</a></p> -->
          <ul class="social_share">
            <li><a href="#." class="facebook"><i class="icon-facebook-1"></i></a></li>
            <li><a href="#." class="twitter"><i class="icon-twitter-1"></i></a></li>
            <li><a href="#." class="google"><i class="icon-google4"></i></a></li>
            <li><a href="#." class="linkden"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#." class="vimo"><i class="icon-vimeo3"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="footer_panel bottom30">
          <h4 class="bottom30">Quick Links</h4>
          <ul class="area_search">
            <li><a href="#."><i class="icon-icons74"></i>Home</a></li>
            <li class="active"><a href="#."><i class="icon-icons74"></i>About Us</a></li>
            <li><a href="#."> <i class="icon-icons74"></i>Property</a></li>
            <li><a href="#."><i class="icon-icons74"></i>Coutact Us</a></li>
            <!-- <li><a href="#."><i class="icon-icons74"></i>Upper East Side, New York</a></li> -->
          </ul>
        </div>
      </div>

      <div class="col-md-4 col-sm-6">
        <div class="footer_panel bottom30">
          <h4 class="bottom30">Get in Touch</h4>
          <ul class="getin_touch">
            <li><i class="icon-telephone114"></i>+91 9355176143</li>
            <li><a href="#."><i class="icon-icons142"></i>info@ringusinfra.com</a></li>
            <li><a href="#."><i class="icon-global"></i>ringusinfra.com/</a></li>
            <li><i class="icon-icons74"></i>Ringus Infra, Noida One Tower B
              Sector 62 , Noida 201309
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>


<!-- <script src="js/jquery-2.1.4.js"></script>  -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Include Owl Carousel JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/jquery-countTo.js"></script>
<script src="js/bootsnav.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/jquery.parallax-1.1.3.js"></script>
<script src="js/jquery.cubeportfolio.min.js"></script>
<script src="js/range-Slider.min.js"></script>
<!-- <script src="js/owl.carousel.min.js"></script>  -->
<script src="js/selectbox-0.2.min.js"></script>
<script src="js/zelect.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/jquery.themepunch.tools.min.js"></script>
<script src="js/jquery.themepunch.revolution.min.js"></script>
<script src="js/revolution.extension.layeranimation.min.js"></script>
<script src="js/revolution.extension.navigation.min.js"></script>
<script src="js/revolution.extension.parallax.min.js"></script>
<script src="js/revolution.extension.slideanims.min.js"></script>
<script src="js/revolution.extension.video.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/functions.js"></script>



<script>
  $(document).ready(function() {
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    });
  });
</script>

</body>

<!-- Mirrored from wahabali.com/work/castle/index8.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Jul 2022 08:48:00 GMT -->

</html>