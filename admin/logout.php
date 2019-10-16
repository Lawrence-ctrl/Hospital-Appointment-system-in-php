<?php
   include('../database/connection.php');
   include('auth.php');
   unset($_SESSION['admin_id']);
   unset($_SESSION['admin_email']);
   header("location:login.php");
   exit;
?>