<?php
session_start();

include('config.php');

// Check if the required fields are set
if (isset($_POST['id'], $_POST['qty'], $_POST['name'], $_POST['transcode'], $_POST['ingre'], $_POST['ids'])) {
    $memid = $_POST['id'];
    $qty = intval($_POST['qty']); // Convert to integer
    $name = $_POST['name'];
    $id = $_POST['ids'];
    $transcode = $_POST['transcode'];
    $ingre = $_POST['ingre'];

    $resultq = mysqli_query($bd, "SELECT * FROM inventory WHERE product_id LIKE '%" . $id . "%'");

    while ($rows = mysqli_fetch_array($resultq)) {
        $pql = $rows['qtyleft'];
        $pqs = $rows['qtysold'];
        $left = $pql - $qty;
        $solds = $pqs + $qty;
        mysqli_query($bd, "UPDATE inventory SET qtyleft='$left', qtysold='$solds' WHERE product_id LIKE '%" . $id . "%'");
    }

    $resulta = mysqli_query($bd, "SELECT * FROM marias_products WHERE id = '$id'");

    while ($row = mysqli_fetch_array($resulta)) {
        $pprice = intval($row['product_price']); // Convert to integer
        $psize = $row['product_size_name'];
    }

    $total = $pprice * $qty;
    mysqli_query($bd, "INSERT INTO orderdetails (customer, qty, price, total, pizzaname, pizasize, transactioncode) VALUES('$memid', '$qty', '$pprice', '$total', '$name', '$psize', '$transcode')");
    header("location: order.php");
    exit();
} else {
    echo "Missing required fields";
}
?>
