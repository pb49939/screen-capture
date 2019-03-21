<?php
include_once("../partials/header.php");
include_once("../partials/nav.php");
include_once("../../BackEnd/dataLayer.php");

if (isset($_GET['wid'])) {
    $websiteID =  $_GET['wid'];
    $dl = new dataLayer();
    $website = $dl->getWebsiteByWebsiteID($websiteID);
    $websiteName = $website["WebsiteName"];
} else {
    // Fallback behaviour goes here
}



?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4"><?php echo($websiteName) ?></h1>
            <div class="list-group" id="task-list">
                <!--  the task list anchor tags are dynamically injected into this DIV from dynamicallyBuild.js  -->
            </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid dash-hero-img" src="../images/asp-web-screenshot.png"
                            alt="First slide" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid dash-hero-img" src="../images/asp-attendance-screenshot.png"
                            alt="Second slide" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid dash-hero-img" src="../images/asp-excuse-screenshot.png"
                            alt="Third slide" />
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div id="task-card-container">
                <!--  the task cards are dynamically injected into this DIV from dynamicallyBuild.js  -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <input hidden id="websiteID" type="text" value=<?php  echo($websiteID)  ?> />

    <?php
      include_once("../partials/footer.php");
     ?>

    <script src="../js/developerWebsite.js"></script>