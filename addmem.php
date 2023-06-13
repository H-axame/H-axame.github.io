<?php
session_start();
$errmsg_arr = array();
$errflag = false;
include('config.php');

$firstname = mysqli_real_escape_string($bd, $_POST['firstname']);
$lastname = mysqli_real_escape_string($bd, $_POST['lastname']);
$email = mysqli_real_escape_string($bd, $_POST['email']);
$pword = mysqli_real_escape_string($bd, $_POST['pword']);
$number = mysqli_real_escape_string($bd, $_POST['number']);
$house = mysqli_real_escape_string($bd, $_POST['house']);
$street = mysqli_real_escape_string($bd, $_POST['street']);
$city = mysqli_real_escape_string($bd, $_POST['city']);

$min_length = 6;

if (strlen($pword) >= $min_length) {
  // Hash the password
  $hashed_password = password_hash($pword, PASSWORD_DEFAULT);

  $query = "INSERT INTO marias_members (firstname, lastname, email, number, house1, street1, city, password) 
            VALUES ('$firstname', '$lastname', '$email', '$number', '$house', '$street', '$city', '$hashed_password')";
  if (mysqli_query($bd, $query)) {
    // Registration successful
    header("location: loginindex.php");
    exit();
  } else {
    $errmsg_arr[] = 'Registration failed. Please try again.';
    $errflag = true;
  }
} else {
  $errmsg_arr[] = 'Password must contain at least 6 characters';
  $errflag = true;
}

if ($errflag) {
  $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
  session_write_close();
  header("location: new.php");
  exit();
}

mysqli_close($bd);
?>
