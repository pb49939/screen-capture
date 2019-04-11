<?php
include_once("../partials/header.php");
include_once("../partials/userTesterNav.php");
include_once("../partials/authenticate.php");
?>

<div style="margin: 10%; margin-top: 5%;">

<h1>HOW TO USE SESSION SANCTUM</h1>
<h2>USER MODE</h2>
<p>In the user mode it is possible to test the tasks that have been created by a developer.</p>
<h3>Testing a task</h3>
<p>To test a task follow the following steps</p>
<ol>
<li>Click the task user wants to test</li>
<li>When asked if user wants to use the extension for Session Sanctum; click "Record".</li>
<li>Once clicked a new window will open, this window is selecting which window user wants recorded. In most cases there will be only one window.</li>
<li>Complete the task(s) instructed by the developer and when finished go to the original tab and click "stop recording".</li>
<li>Once user finished the recording they will be prompted a question of how did it go. If the user feels that the task was easy or met their expectations then they click "Great!" If the task was harder than what they thought or was unclear then they click "Not Great...."</li>
<li>Once the User records their overall satisfaction another window will pop up and will confirm the recording has stoped and will show the user how long it took to complete the task.</li>
</ol>

</div>
<?php include_once("../partials/footer.php");?>