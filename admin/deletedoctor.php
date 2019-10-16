<?php 
  include('../database/connection.php');
  include('auth.php');
      if(isset($_POST['trash_id'])) {
    	$trash_id = $conn->real_escape_string($_POST['trash_id']);
    	$yes = $conn->query("DELETE FROM doctors WHERE doctors_id = '$trash_id'");
    }
?>