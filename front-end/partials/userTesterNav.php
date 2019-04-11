<?php 

?>


<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">The Session Sanctum</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
         
          <li id="user-tester" class="nav-item">
            <a class="nav-link" href="userTesterWebsite.php?wid=1&af=[WILL_BE_ENCRYPTED_ANTIFORGERY_KEY]">Tasks
              <span class="sr-only"></span>
            </a>
          </li>
          <li id="manual" class="nav-item">
            <a class="nav-link" href="userTesterManual.php">Manual</a>
          </li>

    
          <li id="user" class="nav-item">
            <a class="nav-link" href="index.php">| <?php echo($_COOKIE["un"])?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>