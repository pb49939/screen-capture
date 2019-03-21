<?php
include_once("../dataLayer.php");
if (isset($_POST["websiteName"]))
{
$websiteName = $_POST["websiteName"];
}else{
    echo ("ERROR: No websitename in request.");
}
if (isset($_POST["websiteURL"]))
{
$websiteURL = $_POST["websiteURL"];
}else{
    echo ("ERROR: No website url in request.");
}
$dl = new dataLayer();
$website = $dl-> saveNewWebsite($websiteName, $websiteURL);
echo(json_encode($website));
return;
?>