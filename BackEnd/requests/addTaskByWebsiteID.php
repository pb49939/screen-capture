<?php
include_once("../dataLayer.php");
if (isset($_POST["websiteID"]))
{
$websiteID = $_POST["websiteID"];
}else{
    echo ("ERROR: No websiteID in request.");
}
if (isset($_POST["taskName"]))
{
$taskName = $_POST["taskName"];
}else{
    echo ("ERROR: No task name in request.");
}
if (isset($_POST["taskURL"]))
{
$taskURL = $_POST["taskURL"];
}else{
    echo ("ERROR: No task URL in request.");
}
if (isset($_POST["taskImagePath"]))
{
$taskImagePath = $_POST["taskImagePath"];
}else{
    echo ("ERROR: No task image path in request.");
}
if (isset($_POST["taskDescription"]))
{
$taskDescription = $_POST["taskDescription"];
}else{
    echo ("ERROR: No taskDescription in request.");
}
if (isset($_POST["taskUpperDuration"]))
{
$taskUpperDurationThreshold = $_POST["taskUpperDuration"];
}else{
    echo ("ERROR: No task upper duration in request.");
}
if (isset($_POST["taskLowerDuration"]))
{
$taskLowerDurationThreshold = $_POST["taskLowerDuration"];
}else{
    echo ("ERROR: No task lower duration in request.");
}
if (isset($_POST["taskSessions"]))
{
$taskDesiredSessions = $_POST["taskSessions"];
}else{
    echo ("ERROR: No task desired sessions in request.");
}


$dl = new dataLayer();
$task = $dl-> addNewTaskByWebsiteID($websiteID, $taskName, $taskURL, $taskImagePath, $taskDescription, $taskUpperDurationThreshold, $taskLowerDurationThreshold, $taskDesiredSessions);
echo(json_encode($task));
return;
?>