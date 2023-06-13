
<?php
include('config.php');


$encryptionKey = "1234567890123456"; // 16-BIT encryption key
$encryptionIV = "1234567890123456"; // 16-BIT  encryption IV

// Start session and set session cookie flags
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
require_once('auth.php');

// Function to encrypt data using AES
function encryptData($data, $key, $iv) {
  $cipher = "AES-256-CBC";
  $options = OPENSSL_RAW_DATA;
  $encryptedData = openssl_encrypt($data, $cipher, $key, $options, $iv);
  return base64_encode($encryptedData);
}

if (isset($_POST['portal'])) {
  $portal = $_POST['portal'];
} else {
  $portal = '';
}

if (isset($_POST['time'])) {
  $time = $_POST['time'];
} else {
  $time = '';
}

if ($portal == '2') {
  $df = 'Pick-Up';
} elseif ($portal == '1') {
  $df = 'Delivery';
} else {
  $df = '';
}

if (isset($_POST['transactioncode'])) {
  $transactioncode = $_POST['transactioncode'];
} else {
  $transactioncode = '';
}

if (isset($_POST['dist'])) {
  $dist = $_POST['dist'];
} else {
  $dist = '';
}

if (isset($_POST['person'])) {
  $person = $_POST['person'];
} else {
  $person = '';
}

// Encrypt credit card number
if (isset($_POST['card_number'])) {
  $cardNumber = $_POST['card_number'];
  $encryptedCardNumber = encryptData($cardNumber, $encryptionKey, $encryptionIV);
} else {
  $encryptedCardNumber = '';
}

// Store encrypted data in the database
mysqli_query($bd, "INSERT INTO distination (code, dist, agreement, person, time, card_number) VALUES ('$transactioncode', '$dist', '$df', '$person', '$time', '$encryptedCardNumber')");
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Payment Portal</title>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #f1f1f1;
}

.container {
  width: 400px;
  margin: 20px auto;
  background-color: #ffffff;
  border: 3px solid rgba(0, 0, 0, 0);
  border-radius: 5px;
  box-shadow: 0 0 18px rgba(0, 0, 0, 0.4);
  padding: 20px;
  color: #000000;
}

.heading {
  background-color: #0000FF;
  color: #ffffff;
  padding: 5px;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 10px;
}

.form-label {
  font-weight: bold;
}

.form-input {
  margin-bottom: 10px;
  padding: 5px;
  width: 100%;
}

.form-input input[type="text"],
.form-input input[type="submit"] {
  width: 100%;
  padding: 5px;
}

.form-submit {
  text-align: center;
}

.payment-options {
  display: flex;
  justify-content: space-between;
}

.payment-option {
  width: 48%;
}

.payment-option img {
  max-width: 100%;
  height: auto;
}
</style>
</head>
<body>



<div class="container">
  <div class="heading">Mode Of Payment Form</div>

  <form method="post" action="cashconfirm.php">
    <?php
    if (isset($_POST['cusid'])) {
      $cusid = $_POST['cusid'];
    } else {
      $cusid = '';
    }

    if (isset($_POST['total'])) {
      $total = $_POST['total'];
    } else {
      $total = '';
    }

    if (isset($_POST['distination'])) {
      $distination = $_POST['distination'];
    } else {
      $distination = '';
    }

    if ($portal == '2') {
      $charge = 0;
    } elseif ($portal == '1') {
      $charge = 50;
    } else {
      $charge = 0;
    }

    if ($distination == 'City Proper') {
      $charge1 = 0;
    } elseif ($distination == 'Outside City') {
      $charge1 = 50;
    } else {
      $charge1 = 0;
    }

    $totalcharge = intval($charge) + intval($charge1);
    $grandtotal = floatval($totalcharge) + floatval($total);
    ?>

    <input name="transactioncode" type="hidden" value="<?php echo $transactioncode; ?>" />
    <input name="cusid" type="hidden" value="<?php echo $cusid; ?>" />
    <input name="total" type="hidden" value="<?php echo $total; ?>" />
    <input name="grandtotal" type="hidden" value="<?php echo $grandtotal; ?>" />
    <input name="totalcharge" type="hidden" value="<?php echo $totalcharge; ?>" />
    <input name="portal" type="hidden" value="<?php echo $portal; ?>" />
    <input name="distination" type="hidden" value="<?php echo $distination; ?>" /><br />

    <div class="form-submit">
      <input type="submit" value="Pay with Cash" />
    </div>
  </form>

  <form method="post" action="cardconfirm.php">
    <input type="hidden" name="transactioncode" value="<?php echo $transactioncode; ?>" />
    <input type="hidden" name="cusid" value="<?php echo $cusid; ?>" />
    <input type="hidden" name="total" value="<?php echo $total; ?>" />
    <input type="hidden" name="grandtotal" value="<?php echo $grandtotal; ?>" />
    <input type="hidden" name="totalcharge" value="<?php echo $totalcharge; ?>" />
    <input type="hidden" name="portal" value="<?php echo $portal; ?>" />
    <input type="hidden" name="distination" value="<?php echo $distination; ?>" />

    <div class="payment-options">
      <div class="payment-option">
        <h2>Card Payment Details</h2>
        <div class="form-input">
          <label for="card_number" class="form-label">Card Number:</label>
          <input type="text" name="card_number" id="card_number" required />
        </div>

        <div class="form-input">
          <label for="card_expiry" class="form-label">Card Expiry:</label>
          <input type="text" name="card_expiry" id="card_expiry" required />
        </div>

        <div class="form-input">
          <label for="card_cvv" class="form-label">CVV:</label>
          <input type="text" name="card_cvv" id="card_cvv" required />
        </div>

        <div class="form-submit">
          <input type="submit" name="submit" value="Pay with Card" />
        </div>
      </div>

      <div class="payment-option">
        <h2>Pay with Mobile Payment</h2>
        <img src="mobile_payment_logo.png" alt="Mobile Payment Logo" />
        <div class="form-submit">
          <input type="submit" name="submit" value="Pay with Mobile" />
        </div>
      </div>
    </div>
  </form>
</div>

</body>
</html>
