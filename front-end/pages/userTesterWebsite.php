<?php
include_once("../partials/header.php");
include_once("../partials/userTesterNav.php");
include_once("../../BackEnd/dataLayer.php");
include_once("../partials/authenticate.php");

if (isset($_GET['wid'])) {
    $websiteID =  $_GET['wid'];
    $dl = new dataLayer();
    $website = $dl->getWebsiteByWebsiteID($websiteID);
    $websiteName = $website["WebsiteName"];
    $websiteImagePath = $website["WebsiteImagePath"];
} else {
    // Fallback behaviour goes here
}
?>

<!-- Page Content -->
<div class="container">

    <video autoplay id="screen-view" width="20%"></video>
    <button id="stop-screen" style="display:none">Stop the screen</button>
    <button id="play" style="" onclick="play()">Play</button>

    <form id="upload_form" enctype="multipart/form-data" method="post">
        <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
        <h3 id="status"></h3>
        <p id="loaded_n_total"></p>
    </form>

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
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid dash-hero-img" src='<?php echo($websiteImagePath)?>'
                            alt="First slide" />
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
    <div style="display: none;" id="get-screen"></div>
    <div style="display: none;" id="stop-screen"></div>
    <input hidden id="taskID" type="text" value="" />
    <input hidden id="websiteID" type="text" value=<?php  echo($websiteID)  ?> />
    <input hidden id="taskDescription" type="text" value="-1"/>
     <input hidden id="tssPopup" type="text" value="true"/>
    <!-- /.container -->

    <?php
      include_once("../partials/footer.php");
     ?>

    <script src="../js/userTester.js"></script>