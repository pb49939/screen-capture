<?php
include_once("../partials/header.php");



?>



<div class="container register">
  <div class="row">
    <div class="col-md-3 register-left">
      <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
      <h3>The Session Sanctum</h3>
      <p>Applying data driven, automated solutions to testing how users experience your web application.</p>
      <a href="index.php"> <input type="submit" name="" value="Sign In" /></a><br />
    </div>
    <div class="col-md-9 register-right">
      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item">
          <a
            class="nav-link active"
            id="developer"
            data-toggle="tab"
            href="#home"
            role="tab"
            aria-controls="home"
            aria-selected="true"
            >Developer</a
          >
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="user-tester"
            data-toggle="tab"
            href="#profile"
            role="tab"
            aria-controls="profile"
            aria-selected="false"
            >User Tester</a
          >
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div
          class="tab-pane fade show active"
          id="home"
          role="tabpanel"
          aria-labelledby="home-tab"
        >
          <h3 class="register-heading">Register as a Developer</h3>
          <div class="row register-form">
            <div class="col-md-6">
            <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username *"
                  value=""
                  id="d-username"
                />
              </div>  
            <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="First Name *"
                  value=""
                  id="d-first-name"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Last Name *"
                  value=""
                  id="d-last-name"
                />
              </div>
            </div>
            <div class="col-md-6">

            <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  placeholder="Your Email *"
                  value=""
                  id="d-email"
                />
              </div>
              
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Password *"
                  value=""
                  id="d-password"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Confirm Password *"
                  value=""
                   id="d-confirm-password"
                />
              </div>
        
              <input type="submit" class="btnRegister" id="btn-submit-developer" />
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade show"
          id="profile"
          role="tabpanel"
          aria-labelledby="profile-tab"
        >
          <h3 class="register-heading">Apply as a User Tester</h3>
          <div class="row register-form">
            <div class="col-md-6">
            <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Username *"
                  value=""
                  id="ut-username"
                />
              </div>  
            
            <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="First Name *"
                  value=""
                  id="ut-first-name"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Last Name *"
                  value=""
                  id="ut-last-name"
                />
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  placeholder="Email *"
                  value=""
                  id="ut-email"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Password *"
                  value=""
                  id="ut-password"

                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Confirm Password *"
                  value=""
                  id="ut-confirm-password"
                />
              </div>
              
              <input type="submit" class="btnRegister" id="btn-submit-user-tester" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
  include_once("../partials/footer.php");
 ?>

 <script src="../js/register.js"></script>
