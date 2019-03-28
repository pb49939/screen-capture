<html> 
<link href="styles/styles.css" rel="stylesheet"></link>

<head>
    <title>THE SESSION SANCTUM</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

<div id="outer-border"> 

	
	<div class="home-outer-div"> 


  <div id="login-box-background">
  </div>
   
  <div id="login-box">
  
    <div class="left">
    <h1>THE SESSION SANCTUM</h1>
    <h2>Register your account</h2>

    <form id="register">

    
    <input type="text" id="firstName" name="firstName" placeholder="First Name" />
    <input type="text" id="lastName" name="lastName" placeholder="Last Name" />
    <input type="text" id="userName" name="userName" placeholder="Username" />

        <div class="select-container">

            <label for="status">Position</label>

            <select id="position" name="position" form="register">
                <option value="None">None</option>
                <option value="User Tester">User Tester</option>
                <option value="Developer">Developer</option>

            </select>

    </div>

    <input type="email" id="email" name="email" placeholder="Email" />

    <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" />

    <input type="password" id="password1" name="password1" placeholder="Password" />

    <input type="password" id="password2" name="password2" placeholder="Confirm Password" />

    <input type="submit" name="register" value="register" id="btn-submit"/>


    </form>

    <a href="/index.php"><p id="reg">Already have an account? Sign in here.</p></a>

  </div>

  <span id="result"></span>
  
  
</div>

<div class="sign-in">

</div>	
		
	</div>

</div>


</body>

</html>

<?php include_once("../partials/footer.php");?>

<script src="../js/register.js"></script>