<?php
include_once("../dataLayer.php");

if (isset($_POST["websiteID"]))
{
$websiteID = $_POST["websiteID"];
}else{
    echo ("ERROR: No websiteID in request to get recordings.");
}


$dl = new dataLayer();
$tasks = $dl->getAllTasksByWebsiteID($websiteID);
echo(json_encode($tasks));

return;


?>