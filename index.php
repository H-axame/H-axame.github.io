<?php
//Setting the HTTPOnly flag on session cookies: ini_set('session.cookie_httponly', 1) 
//helps protect against XSS attacks by preventing JavaScript access to session cookies.

//Setting secure and HTTPOnly flags on session cookies: session_set_cookie_params() 
//sets the cookie parameters to ensure that session cookies are only transmitted over HTTPS and are not accessible via JavaScript.

//Regenerating session ID and checking client IP and user agent: 
//The code checks if the session ID, client IP, and user agent remain the same throughout the session. If any of these values change, 
//it indicates a possible session hijacking attempt, and the session is destroyed.

// Enable HTTPOnly flag on session cookies
ini_set('session.cookie_httponly', 1);  

// Set session cookie settings
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Start session
session_start();

// Regenerate session ID and delete old session data
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Store client IP and user agent in session
if (!isset($_SESSION['client_ip'])) {
    $_SESSION['client_ip'] = $_SERVER['REMOTE_ADDR'];
}

if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
}

// Check for session hijacking
if ($_SESSION['client_ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    // Destroy the session and redirect to an error page
    session_destroy();
    header("Location: error.php");
    exit();
}

// Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_FIRST_NAME']);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Roman's pizza</title>

<meta name="keywords" content="free website templates, CSS layout, Pizza Company Website, HTML CSS" />

<meta name="description" content="Pizza Company Website - free CSS website template, Free HTML CSS Layout" />

<link href="templatemo_style.css" rel="stylesheet" type="text/css" />


<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
 
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
</head>
<body>
<div id="templatemo_container">
  <div id="templatemo_header_section"> </div>
  <div id="templatemo_menu_bg">
    <div id="templatemo_menu">
      <ul>
        <li><a href="index.html"  class="current">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Location</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="loginindex.php">Order Now! </a></li>
        <li><a href="franchise.php">Franchise</a></li>
      </ul>
    </div>
  </div>
  <div id="templatemo_header_pizza"> </div>
  <div id="templatemo_content">
    <div id="templatemo_content_left"><img src="images/main1.jpg" width="729" height="312" style="margin-left:-10px;" /></div>
    <div id="templatemo_card"></div>
  </div>
  <div id="templatemo_container_end"> </div>
</div>
<div id="templatemo_footer">
  <div class="top"></div>
  <div class="middle">Copyright © Roman's pizza</div>
  <div class="button"></div>
</div>
<div>
</div>
</body>

</html>
