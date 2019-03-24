<?php
include_once("../dataLayer.php");

if (isset($_POST["websiteID"]))
{
$websiteID = $_POST["websiteID"];
}else{
    echo ("ERROR: No websiteID in request to get website info.");
}


$dl = new dataLayer();
$websiteInfo = $dl->getWebsiteInfo($websiteID);
echo(json_encode($websiteInfo));

return;


?>