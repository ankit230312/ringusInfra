<?php include "common/header.php";


$blogId = $_GET['id'];
if (empty($blogId) || !is_numeric($blogId)) {
    die("Invalid blog ID");
}

// Prepare and execute SQL query
$sql = "SELECT * FROM blog WHERE id = $blogId";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
} else {
    echo "<script> alert('No records found')</script>";
}

// Close the database connection
// $conn->close();

?>





<section class="page-banner padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-uppercase"><?php echo $row['name']; ?></h1>
                <!-- <p>Serving you since 1999. Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
            <ol class="breadcrumb text-center">
               <li><a href="#.">Home</a></li>
               <li><a href="#.">Properties</a></li>
               <li class="active">Property Details - 3</li>
            </ol> -->
            </div>
        </div>
    </div>
</section>
<!-- Page Banner End -->


<!-- Property Detail Start -->
<section id="property" class="padding">
    <div class="container property-details">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-uppercase"><?php echo $row['name']; ?></h2>
                <!-- <p class="bottom30"><?php echo $row['name']; ?></p> -->
                <div id="property-d-1" class="owl-carousel single imageBlock">
                    <div class="item"><img src="images/property-details/property-d-1-1.jpg" alt="image" /></div>
                    
                </div>
               
                <div class="property_meta bg-black bottom40">
                    <span><i class="icon-select-an-objecto-tool"></i><?php echo $row['created_at']; ?></span>
                    <!-- <span><i class=" icon-microphone"></i>2 Office Rooms</span>
                    <span><i class="icon-safety-shower"></i>1 Bathroom</span>
                    <span><i class="icon-old-television"></i>TV Lounge</span>
                    <span><i class="icon-garage"></i>1 Garage</span> -->
                </div>
            </div>
            <div class="col-md-8 listing1">
                <h2 class="text-uppercase">Property Description</h2>
                <p class="bottom30"><?php echo $row['desc']; ?></p>
                <!-- <p class="bottom30">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis et metus in libero sollicitudin venenatis eu sed enim. Nam felis lorem, suscipit ac nisl ac, iaculis dapibus tellus. Cras ante justo, aliquet quis placerat nec, molestie id turpis. </p> -->
                <!-- <div class="text-it-p bottom40">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam power nonummy nibh tempor cum soluta nobis eleifend option congue nihil imperdiet doming Lorem ipsum dolor sit amet. consectetuer elit sed diam power nonummy</p>
                </div> -->
                
              
               
               
              
              
            </div>
            <aside class="col-md-4 col-xs-12">
                <h2 class="text-uppercase bottom20">For More Details</h2>
                <div class="row">
                    
                    <div class="col-sm-12 agent_wrap bottom30">
                        <table class="agent_contact table">
                            <tbody>
                                <tr class="bottom10">
                                    <td><strong>Phone:</strong></td>
                                    <td class="text-right">+91 9355176143</td>
                                </tr>
                                <tr class="bottom10">
                                    <td><strong>Mobile:</strong></td>
                                    <td class="text-right">+91 9355176143</td>
                                </tr>
                                <tr>
                                    <td><strong>Email Adress:</strong></td>
                                    <td class="text-right"><a href="#.">info@ringusinfra.com</a></td>
                                </tr>
                                <!-- <tr>
                                    <td><strong>Skype:</strong></td>
                                    <td class="text-right"><a href="#.">bohdan.kononets</a></td>
                                </tr> -->
                            </tbody>
                        </table>
                        <div style="border-bottom:1px solid #d3d8dd;" class="bottom15"></div>
                    </div>
                    <div class="col-sm-12 bottom40">
                        <!-- <form class="callus">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message"></textarea>
                            </div>
                            <input type="submit" class="btn-blue uppercase border_radius" value="submit now">
                        </form> -->
                    </div>
                 
                </div>
          
              
            
             
            </aside>
        </div>
    </div>
</section>



<?php include "common/footer.php"; ?>