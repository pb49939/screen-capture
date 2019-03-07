<?php
include_once("../dataLayer.php");

if (isset($_POST["taskID"]))
{
$taskID = $_POST["taskID"];
}else{
    echo ("ERROR: No taskID in request to get recordings.");
}


$dl = new dataLayer();
$recordings = $dl->getAllRecordingsByTaskID($taskID);
echo(json_encode($recordings));

return;


?>