<?php
include_once("../partials/header.php");
include_once("../partials/nav.php");
?>

<!-- Page Content -->
<div class="container">
    <div class="row vertical-spacer">
    

        <div class="col-lg-12">
            <div id="task-card-container">
                <!--  the task cards are dynamically injected into this DIV from dynamicallyBuild.js  -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <?php
      include_once("../partials/footer.php");
     ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
    <script src="../js/developerDashboard.js"></script>