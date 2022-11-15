<?php
	require 'config.php';
	if(!empty($_SESSION['name']))
		header('Location: dashboard.php');
?>
<!DOCTYPE html>
<html>
<title>VCS</title>
<meta charset="UTF-8">
<link rel="icon" href="./img/murom.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
body {font-family: "Times New Roman", Georgia, Serif;}
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display";
  letter-spacing: 5px;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="" class="w3-bar-item w3-button"><img src="./img/1.png" class="w3-round w3-image w3-opacity-min" width="150" height="200"></a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
			<a href="login.php" class="w3-bar-item w3-button">Login</a>
			<a href="register.php" class="w3-bar-item w3-button">Register</a>
    </div>
  </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <img class="w3-image" src="/w3images/hamburger.jpg" alt="Hamburger Catering" width="1600" height="800">
  <div class="w3-display-bottomleft w3-padding-large w3-opacity">
    <h1 class="w3-xxlarge">Le Catering</h1>
  </div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large">
        <br>
        <br>
      <h1 class="w3-center">Please login to continue</h1><br>
      </div>
  </div>
</div>

</body>
</html>
