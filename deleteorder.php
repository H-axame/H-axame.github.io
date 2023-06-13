<?php
if (isset($_GET['id'])) {
    include('config.php');
    $id = $_GET['id'];

    $bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

    if (!$bd) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    mysqli_query($bd, "DELETE FROM orderdetails WHERE orderid='$id'");
    mysqli_close($bd);
    header("location: order.php");
    exit();
}
?>

			
