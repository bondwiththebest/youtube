<?php
echo "<h1> hello</h1>";

session_start();
echo $_SESSION['user_id'];

session_destroy();
?>
