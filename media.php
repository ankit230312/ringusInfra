<?php include "common/header.php"; ?>
<!-- Page Banner Start-->
<section class="page-banner padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-uppercase">Media</h1>

            </div>
        </div>
    </div>
</section>
<!-- Page Banner End -->



<!-- Agent Start -->
<section id="agent-2" class="padding_top padding_bottom_half">
    <div class="container">
        <div class="row">

            <!-- <div class="col-sm-4 bottom40">
        <div class="agent_wrap">
          <div class="image">
            <img src="images/agent-one.jpg" alt="Agents">
            <div class="img-info">
              <h3>Bohdan Kononets</h3>
              <span>sales executive</span>
              <p class="top20 bottom30">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh tempor cum soluta nobis consectetuer.</p>
          
              <hr>
              <a class="btn-more" href="javascript:void(0)">
           
              </a>
            </div>
          </div>
        </div>
      </div> -->
            <?php
            // Assuming you have a database connection $conn

            // Query to retrieve agent data based on agent ID
            $agentId = 1; // Replace with the actual agent ID
            $sql = "SELECT * FROM media WHERE status = 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($rowData = $result->fetch_assoc()) { ?>
                    <div class="col-sm-4 bottom40">
                        <div class="agent_wrap">
                            <div class="image">
                                <img src="admin/<?php echo $rowData['mediaImage']; ?>" alt="Agents">
                                <div class="img-info">
                                    <h3><?php echo $rowData['mediaTitle']; ?></h3>
                                    <span><?php echo $rowData['mediaShortDesc']; ?></span>
                                    <p class="top20 bottom30"><?php echo $rowData['mediaLongDesc']; ?></p>
                                    <hr>
                                    <a class="btn-more" href="#">
                                        <i><img alt="arrow" src="images/arrow-yellow.png"></i>
                                        <span></span>
                                        <i><img alt="arrow" src="images/arrow-yellow.png"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php

                }
            } else {
                // Handle the case where no agent is found
                $rowData = array(); // Set default values or handle accordingly
            }
            ?>





        </div>
    </div>
</section>
<!-- Agent End -->





<?php include "common/footer.php"; ?>