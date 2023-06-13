<?php
	// Start session
	session_start();
	
	// Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roman's Pizza</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <!--sa poip up-->
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage : 'src/loading.gif',
                closeImage   : 'src/closelabel.png'
            });
        });
    </script>
  <style>
    body {
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
    }

    .container {
      width: 300px;
      margin: 0 auto;
      position: relative;
      border: 3px solid rgba(0, 0, 0, 0);
      border-radius: 5px;
      box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
      margin-top: 20px;
      color: #000000;
    }

    .header {
      background-color: #ff3300;
      font-family: Arial, Helvetica, sans-serif;
      color: #000000;
      padding: 5px;
      height: 22px;
    }

    .header strong {
      float: left;
    }

    .header a {
      float: right;
      margin-right: 3px;
      background-color: #cccccc;
      width: 25px;
      text-align: center;
      height: 22px;
      text-decoration: none;
      color: #000000;
    }

    .header a:hover {
      background-color: #999999;
    }

    table {
      width: 286px;
      margin: 0 auto;
    }

    td {
      padding: 5px;
    }

    .error-message {
      font-family: Arial, Helvetica, sans-serif;
      color: #ff0000;
      font-size: 12px;
      margin-top: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 5px;
    }

    .form-group {
      margin-top: 10px;
    }

    .form-group a {
      text-decoration: none;
      color: #0000ff;
    }

    .form-group a:hover {
      text-decoration: underline;
    }

    .form-group input[type="submit"] {
      width: auto;
      padding: 5px 10px;
      background-color: #0000ff;
      color: #ffffff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <strong>Members Login</strong>
      <a href="index.php">X</a>
    </div>
    <form id="form1" name="login" method="post" action="loginexec.php" onsubmit="return validateForm()">
      <div class="error-message">
      <?php
          if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
            echo '<ul class="err">';
            foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
              echo '<li>' . htmlspecialchars($msg) . '</li>'; // Apply HTML escaping to prevent xss
            }
            echo '</ul>';
            unset($_SESSION['ERRMSG_ARR']);
          }
        ?>
      </div>
      <table>
        <tr>
          <td align="right">Email:</td>
          <td><input type="text" name="user" /></td>
        </tr>
        <tr>
          <td align="right">Password:</td>
          <td><input type="password" name="password" /></td>
        </tr>
        <tr>
          <td></td>
          <td class="form-group">
            <a href="new.php">No account? Register here</a>
          </td>
        </tr>
        <tr>
          <td></td>
          <td class="form-group">
            <input type="submit" name="Submit" value="Login" />
          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>
