<?php
include_once("../partials/header.php");
include_once("../partials/nav.php");
include_once("../../BackEnd/dataLayer.php");
include_once("../partials/authenticate.php");


if (isset($_GET['tid'])) {
    $taskID =  $_GET['tid'];
    $dl = new dataLayer();
    $recordings = $dl->getAllRecordingsByTaskID($taskID);
    $path = $recordings[0]["RecordingPath"];
    $websiteName = $recordings[0]["WebsiteName"];
    
} else {
    // Fallback behaviour goes here
}

$dl = new dataLayer();
$task = $dl->getTaskByTaskID($taskID);
$taskName = $task["TaskName"];


?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-12">

            <h1 class="my-4">
                <?php echo($websiteName)?>  -  <?php echo($taskName) ?></h1>

            
        </div>

    </div>

    <div class="row">
        <!-- /.col-lg-12 -->

        <div class="col-lg-12">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox" id="recording-active">
                    <div class="carousel-item active" >
                        <video class="d-block img-fluid dash-hero-img" alt="First slide" controls="" autoplay=""
                            name="media" id="screen-view">
                            <source id="recording-source" src=<?php echo($path) ?> type="video/webm">
                        </video>
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

            <div class="row" id="task-cards-holding-recordings-row">



            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

    <div class="row">

        <div class="col-lg-12">


            <div class="task-info-container">
                <div class="duration-container">
                    Duration Information
                    <canvas id="duration" width="400" height="400"></canvas>
                    <div class="stats-container">
                        <div id="upper-duration-threshold">Upper Duration Threshold: <strong><span id="upper-duration-threshold-val"></span></strong></div>
                        <div id="lower-duration-threshold">Lower Duration Threshold: <strong><span id="lower-duration-threshold-val"></span></strong></div>
                        <div id="standard-deviation">Standard Deviation: <strong><span id="standard-deviation-val"></span></strong></div>
                        <div id="mean">Mean: <strong><span id="mean-val"></span></strong></div>
                        <div id="range">Range: <strong><span id="range-val"></span></strong></div>
                        <div id="mode">Mode: <strong><span id="mode-val"></span></strong></div>
                        <div id="median">Median: <strong><span id="median-val"></span></strong></div>
                    </div>
                </div>
                <div class="positive-feel-container">
                    Positive Feel Information
                    <canvas id="positive-feel" width="400" height="400"></canvas>
                    <div class="stats-container">
                        <div id="positive-feel">Positive Feel: <strong><span id="positive-feel-val"></span></strong></div>
                        <div id="lacking-positive-feel">Lacking Positive Feel: <strong><span id="lacking-positive-feel-val"></span></strong></div>
                    </div>  
                </div>
            </div>    

        </div>

    </div>


    <input hidden id="taskID" type="text" value=<?php  echo($taskID)  ?> />
</div> <!-- /.container -->



<?php
include_once("../partials/footer.php");
?>

<script src="../js/watch.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>