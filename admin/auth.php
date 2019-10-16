<?php
  session_start();
  include('../database/connection.php');
  if(empty($_SESSION['admin_id']) and empty($_SESSION['admin_email'])) {
  	header("location:login.php");
  	exit;
  }
?>