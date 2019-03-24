<?php
include_once("../dataLayer.php");

if (isset($_POST["userID"]))
{
$userID = $_POST["userID"];
}else{
    echo ("ERROR: No userID in request to get websites.");
}


$dl = new dataLayer();
$websites = $dl->getAllWebsitesByUserID($userID);
echo(json_encode($websites));

return;


?>