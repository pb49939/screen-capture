<?php
include_once("dataLayer.php");

if (isset($_POST["taskID"]))
{
$taskID = $_POST["taskID"];
}else{
    echo ("ERROR: No taskID in request to save recording.");
}

if (isset($_POST["duration"]))
{
$duration = $_POST["duration"];
}else{
    echo ("ERROR: No duration in request to save recording.");
}

if(isset($_POST['positiveFeel'])){
    $positiveFeel = $_POST['positiveFeel'];

    if ($positiveFeel == "true"){
        $positiveFeel = true;
    }else{
        $positiveFeel = false;
    }
}else{
    $positiveFeel = false;
}

$dl = new dataLayer();
$recordingID = $dl-> saveNewRecording($taskID, $duration, $positiveFeel);


//$fileName = $_FILES["file1"]["name"] . date('m/d/Y_h:i:s', time()); // The file name
$fileName = $_FILES["file1"]["name"] . $recordingID; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo ("ERROR: Please browse for a file before clicking the upload button.");
    exit();
}

$myfile = fopen(__DIR__ . "/recordings/$fileName", "w");

if(move_uploaded_file($fileTmpLoc, "recordings/$fileName")){
} else {
    echo ("move_uploaded_file function failed");
}


//since the test thing works for the filename, we are going to start giving every recording an ID in the database and then when we name a video, we will check what the last id was and increment from there 
//all we have to do is replace "test" with the new id
?>