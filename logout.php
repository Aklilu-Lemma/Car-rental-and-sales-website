<?php
session_start();
unset($user_id);
session_destroy();
header('location:index.php');
?>