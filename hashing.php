<?php
// Hash the password using bcrypt algorithm
function hashPassword($password) {
  $options = [
    'cost' => 12, // Adjust the cost parameter according to your server's performance
  ];
  return password_hash($password, PASSWORD_BCRYPT, $options);
}

// Verify if the password matches the hashed password
function verifyPassword($password, $hashedPassword) {
  return password_verify($password, $hashedPassword);
}
?>
