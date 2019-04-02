<?php
include_once("../dataLayer.php");

if (isset($_POST["websiteID"]))
{
$websiteID = $_POST["websiteID"];
}else{
    echo ("ERROR: No website ID in request to get recordings.");
}


$dl = new dataLayer();
$tasks = $dl->getAllTasksForUserTester($websiteID);
echo(json_encode($tasks));

return;


?>