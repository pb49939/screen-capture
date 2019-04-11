<?php
include_once("../partials/header.php");
include_once("../partials/devNav.php");
include_once("../partials/authenticate.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>

  
<title> Add A New Site </title>

</head>

	<body>

      <form name="add-task">
        <div class="form-style-10 form-left">
            <h1>Add A New Site!<span>Add a new site for UI testing</span></h1>
            <form>
                <div class="section"><span>1</span>Site Name</div>
                <div class="inner-wrap">
                    <label>Name of site to be tested: <input type="text" name="site_name" id="site_name" required /></label>
                </div>
                <div class="section"><span>2</span>Site's URL</div>
                <div class="inner-wrap">
                    <label>URL of page to be tested:<br /><input type="text" name="siteurl2" id="site_url2" placeholder="https://" readonly/><input type="text" name="siteurl" id="site_url" required /></label>
                    <div class="btn-primary" onclick="testURL()">Test URL</div>
                </div> 
                <div class="section"><span>3</span>Site's Image Path</div>
                <div class="inner-wrap">
                    <label>Image used for this website: <input type="text" name="siteimgpath" id="site_img_path" required /></label>
                </div>  
            
            
                <div class="button-section">
                 <button class="btn btn-primary" id="btn-submit">Submit</button>
                </div>
            </form>
            </div>

            <div class="frame-mount" id="frame-mount">
               
            </div>

            
            
</body>

</html>


<?php include_once("../partials/footer.php");?>

<script src="../js/addWebsite.js"></script>
