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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="nameQ" id="Name">
          </div>
          <div class="form-group">

            <label for="message-text" class="col-form-label">Email:</label>
            <input type="email" class="form-control" name="emailQ" id="Email">
            <!-- <textarea class="form-control" id="message-text"></textarea> -->

          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Mobile</label>
            <input type="number" class="form-control" name="mobileQ" id="Mobile">
            <!-- <textarea class="form-control" id="message-text"></textarea> -->
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description</label>

            <textarea class="form-control" name="descQ" id="message-text"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="querySubmit" class="btn btn-primary">Send message</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php


if (isset($_POST['querySubmit'])) {
  // Escape user inputs for security
  
  $lead_nameQ = mysqli_real_escape_string($conn, $_POST['nameQ']);
  $lead_mobileQ = mysqli_real_escape_string($conn, $_POST['mobileQ']);
  $lead_emailQ = mysqli_real_escape_string($conn, $_POST['emailQ']);
  $lead_desQ = mysqli_real_escape_string($conn, $_POST['descQ']);

  // Insert data into the database
  $sql = "INSERT INTO lead (lead_name, lead_mobile ,lead_email, lead_des) VALUES ('$lead_nameQ','$lead_mobileQ' , '$lead_emailQ', '$lead_desQ')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('We will continue you soon');
      window.location.href = 'index.php' 
      </script>";
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}



?>



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