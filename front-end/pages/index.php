<?php
include_once("../partials/header.php");



?>



<div class="container register">
  <div class="row">
    <div class="col-md-3 register-left">
      <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
      <h3>The Session Sanctum</h3>
      <p>Applying data driven, automated solutions to testing how users experience your web application.</p>
      <a href="register.php"> <input type="submit" name="" value="Register" /></a><br />
    </div>
    <div class="col-md-9 register-right">
    
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="home"
          role="tabpanel"
          aria-labelledby="home-tab"
        >
          <h3 class="register-heading">Sign In</h3>
          <div class="row register-form">
            <div class="col-md-6">
            <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username"
                  value=""
                  id="username"
                />
              </div>
</div> 
               <div class="col-md-6"> 
                    <div class="form-group">
                      <input
                        type="password"
                        class="form-control"
                        placeholder="Password "
                        value=""
                        id="password"
                      />
                    </div>
              </div> 
        
              <input type="submit" class="btnRegister full-width" id="btn-sign-in" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<a href="developerDashboard.php" id="authenticatedD"></a>
<a href="userTesterWebsite.php?wid=1" id="authenticatedUT"></a>

<?php
  include_once("../partials/footer.php");
 ?>

 <script src="../js/login.js"></script>
