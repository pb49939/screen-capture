<?php
include_once("../dataLayer.php");


$dl = new dataLayer();
$tasks = $dl->getAllTasks();
echo(json_encode($tasks));

return;


?>