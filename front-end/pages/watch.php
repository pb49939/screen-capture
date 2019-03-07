<?php
include_once("../partials/header.php");
include_once("../partials/nav.php");
include_once("../../BackEnd/dataLayer.php");


if (isset($_GET['tid'])) {
    $taskID =  $_GET['tid'];
    $dl = new dataLayer();
    $recordings = $dl->getAllRecordingsByTaskID($taskID);
    $path = $recordings[0]["RecordingPath"];
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

        <div class="col-lg-3">

            <h1 class="my-4">alphasigs.org -
                <?php echo($taskName) ?></h1>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

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

    <input hidden id="taskID" type="text" value=<?php  echo($taskID)  ?> />
</div> <!-- /.container -->



<?php
include_once("../partials/footer.php");
?>

<script src="../js/watch.js"></script>