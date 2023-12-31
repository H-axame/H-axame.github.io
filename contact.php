<?php
    // Start session
    session_start();

    // Unset the variables stored in session
    unset($_SESSION['SESS_MEMBER_ID']);
    unset($_SESSION['SESS_FIRST_NAME']);

    // Generate and set CSRF token
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Roman's pizza</title>

<meta name="keywords" content="free website templates, CSS layout, Pizza Company Website, HTML CSS" />

<meta name="description" content="Pizza Company Website - free CSS website template, Free HTML CSS Layout" />

<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
    font-size: 16px;
    font-weight: bold;
}
-->
</style>
</head>
<body>
<div id="templatemo_container">
    <div id="templatemo_header_section"> </div>
    <div id="templatemo_menu_bg">
        <div id="templatemo_menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contact.php"  class="current">Location</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="loginindex.php">Order Now! </a></li>
                <li><a href="franchise.php">Franchise</a></li>
            </ul>
        </div>
    </div>
    <div id="templatemo_header_pizza"> </div>
    <div id="templatemo_content">
        <div id="templatemo_content_left">
            <div class="text" style="color:#000000">
                <iframe width="685" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.ph/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Bacolod+City,+Western+Visayas&amp;aq=0&amp;oq=bacolod+city&amp;sll=12.867031,121.766552&amp;sspn=22.691867,43.286133&amp;ie=UTF8&amp;hq=&amp;hnear=Bacolod+City,+Negros+Occidental,+Western+Visayas&amp;t=m&amp;ll=10.671368,122.951506&amp;spn=0.001845,0.003219&amp;z=18&amp;iwloc=lyrftr:m,15792293577711675161,10.670856,122.951109&amp;output=embed"></iframe><br />
            </div>
        </div>
    </div>
</div>

<div>
</div>
<script>
    // Set CSRF token value in JavaScript variable
    var csrfToken = "<?php echo $_SESSION['csrf_token']; ?>";
</script>
</body>
</html>
