<?php
	require_once('auth.php');
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Roman's pizza</title>
<style type="text/css">
<!--
.style1 {
    font-size: 24px;
    font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
.style4 {font-size: 16px}
-->
</style>
</head>

<body>
<?php
include('config.php');

$cusid = $_POST['cusid'];
$grandtotal = $_POST['grandtotal'];
$transactioncode = $_POST['transactioncode'];
$trasactiondate = date("m/d/Y");
$status = 'Completed';
$mode = 'Cash';

mysqli_query($bd, "INSERT INTO marias_orders (cusid, amountpaid, status, transactiondate, transactioncode, mode) VALUES ('$cusid', '$grandtotal', '$status', '$trasactiondate', '$transactioncode', '$mode')");

?>

<div style="margin:0 auto; width:400px; height:auto; font-family:Arial, Helvetica, sans-serif; font-size:10px; text-align:right;"><a href="index.php">Logout</a></div>
<div style="margin:0 auto; width:400px; height:auto; font-family:Arial, Helvetica, sans-serif; font-size:10px;">
    <div align="center"><img src="images/REPORTLOGO.jpg" /></div><br /><br />
    <div align="center" class="style1 style4">ORDER CONFIRMATION</div>
    <br /><br />
    <div align="right">Date<strong>:<?php echo date("m/d/Y");?></strong></div>
    <br /><br />
    <div align="left"><strong>Transaction Code:<?php echo $_POST['transactioncode'];?></strong></div>
    <br />
    <?php
    include('config.php');
    $memid = $_POST['cusid'];
    $result = mysqli_query($bd, "SELECT * FROM marias_members where id = '$memid'");
    $row1 = mysqli_fetch_array($result);

    if ($row1) {
        echo '<div align="left">Customer Name:<strong>' . $row1['firstname'] . ' ' . $row1['lastname'] . '</strong></div><br />';
        echo '<div align="left">Address:<strong>' . $row1['house1'] . ', ' . $row1['street1'] . ', ' . $row1['city'] . '</strong></div><br />';
    } else {
        echo 'Customer information not found.';
    }
    ?>

    Items:<br />
    <span class="style2">
    <?php
            include('config.php');

            $transactioncode = $_POST['transactioncode'];

            // Retrieve order details
            $stmt = mysqli_prepare($bd, "SELECT * FROM orderdetails WHERE transactioncode = ?");
            mysqli_stmt_bind_param($stmt, "s", $transactioncode);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row1 = mysqli_fetch_array($result)) {
                echo $row1['pizzaname'] . ' ' . $row1['pizasize'] . '&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;' . $row1['qty'] . '<br>';
            }

            mysqli_stmt_close($stmt);

            echo 'Total Payable: RM ';

            // Calculate total payable amount
            $stmt = mysqli_prepare($bd, "SELECT SUM(total) AS totalSum FROM orderdetails WHERE transactioncode = ?");
            mysqli_stmt_bind_param($stmt, "s", $transactioncode);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row1 = mysqli_fetch_array($result)) {
                echo $row1['totalSum'];
            }

            mysqli_stmt_close($stmt);
?>


       

    </span><br />
    
    <br />
    <?php
        include('config.php');

        // Define the encryption key and IV
        $encryptionKey = "1234567890123456"; // 16-BIT encryption key
        $encryptionIV = "1234567890123456"; // 16-BIT  encryption IV

        // Function to decrypt the data
        function decryptData($data, $key, $iv) {
            $decryptedData = openssl_decrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
            return $decryptedData;
        }

        // Decrypt the credit card number
        if (isset($_POST['card_number'])) {
            $encryptedCardNumber = $_POST['card_number'];
            $decryptedCardNumber = decryptData($encryptedCardNumber, $encryptionKey, $encryptionIV);

            echo " Credit Card Number: " . $decryptedCardNumber;
        } else {
            echo "Credit card number not found.";
        }
        ?>
    <br /><br />
    <div align="center">
    THIS IS SERVE AS YOUR OFFICIAL RECEIPT<BR />THANK YOU FOR CHOOSING Roman's pizza<BR />OPTIONAL FOR PRINTING<br>NOTE: Expect a phone call confirmation before the delivery
    </div>
</div>



</body>
</html>
