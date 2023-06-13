<?php
// Start session
session_start();

// Connect to MySQL server
include('config.php');

$errmsg_arr = array();

// Validation error flag
$errflag = false;

// Function to sanitize values received from the form. Prevents SQL injection
function clean($str) {
    global $bd;

    $str = trim($str);
    $str = stripslashes($str);
    $str = mysqli_real_escape_string($bd, $str);

    return $str;
}

$login = clean($_POST['user']);
$password = clean($_POST['password']);

// Retrieve the hashed password from the database based on the user's login
$qry = "SELECT * FROM marias_members WHERE email = ?";
$stmt = mysqli_prepare($bd, $qry);
mysqli_stmt_bind_param($stmt, "s", $login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check whether the query was successful or not
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $member = mysqli_fetch_assoc($result);
        $hashed_password = $member['password'];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, login successful
            session_regenerate_id();
            $_SESSION['SESS_MEMBER_ID'] = $member['id'];
            $_SESSION['SESS_FIRST_NAME'] = $member['confirmation'];
            session_write_close();

            // Redirect the user to the secure "order.php" page
            header("location: order.php");
            exit();
        } else {
            // Login failed - incorrect password
            $errmsg_arr[] = 'Invalid password';
            $errflag = true;
        }
    } else {
        // Login failed - user does not exist
        $errmsg_arr[] = 'User does not exist';
        $errflag = true;
    }
} else {
    die("Query failed");
}

if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();

    // Redirect the user back to the login page with an error message
    header("location: loginindex.php");
    exit();
}
?>
