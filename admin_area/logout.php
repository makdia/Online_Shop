<?php
session_start();
session_destroy();
echo"<script>window.open('login.php?logged_out=You have successfully Logged Out!','_self')</script>";
?>