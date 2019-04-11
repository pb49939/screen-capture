<?php
include_once("../partials/header.php");
include_once("../partials/devNav.php");
include_once("../partials/authenticate.php");
?>

<div style="margin: 10%; margin-top: 5%;">

<h1>HOW TO USE SESSION SANCTUM</h1>
<h2>DEVELOPER MODE</h2>
<h3>Developer Dashboard</h3>
<p>The developer dashboard shows all websites currently associated with that developer account and it also shows. The number of total sessions that have been done on each site.</p>
<h3>Managing a Website</h3>
<p>To manage a website click the blue manage website button, once clicked it will take developer to the website managing page. <br /><br /> Once here, developer may add new tasks or edit ones already in existance. To add a new task all that needs to be done is clicking the blue box that says "add new task" at the bottom of the task page in the website manager. Once here there is a seven step process to create a new task.</p>
<h3>Creating a New Task</h3>
<ol>
<li>Task name, this is what the developer wants as a task name. For example, "Resigster for a class</li>
<li>Website URL, this is the path to the website so that a session can be recorded. For example, http://mysail.oakland.edu</li>
<li>Take a screenshot, this is optional. It is more a reference point for testers to know that they are at the right point in the website.</li>
<li>Task Description, this is what is the tester trying to acomplish with this particular task. <strong>Note: if any guest accounts are needed for a task this is where to include them</strong></li>
<li>Upper Duration Threshold, this is how long the developer things is the absolute maximum amount of time a particular task should take. Anything that is about this time threshold will show are <span style="color: #ff0000;">RED </span>border when viewing the task in website manager.</li>
<li>Lower Duration Threshold, this is how long the developer believes the task should take in seconds. If a task is finished sooner than the developer thinks the border of the task will show as <span style="color: #339966;">GREEN </span>in the website manager.<strong> Note: if a task is completed within the two thresholds then border will then be <span style="color: #ffcc00;">YELLOW</span>.</strong></li>
<li>Desired Session Count, this is how many sessions would the developer like to have recorded for this particular task.</li>
</ol>
<p><strong>Note: If a developer wants to test a task out they must click the "User Tester" tab on the ribbon at the top of the site. For help on the user tester tab, follow the "User Mode" section of ths guide. </strong></p>
<h3>Data Analytics</h3>
<p>On the manage website page it is also possible to see how many times a task has been completed, the average time of completion, and the overall satisfaction rating of a particular task. By clicking on a particular task, it is possible to see the time needed to complete and the satisfaction of each recording of that task. By clicking on a recording a developer can view the screen capture. At the bottom of the page there are graphs that show percentage of satisfaction and dissatisfaction as well as the range, median, mean, and mode for that particular task.</p>

</div>
<?php include_once("../partials/footer.php");?>