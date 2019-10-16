<?php 
  include('../database/connection.php');
  include('auth.php');
      if(isset($_POST['edit_id'])) {
    	$edit_id = $conn->real_escape_string($_POST['edit_id']);
    	$yw = $conn->query("SELECT * FROM departments WHERE departments_id ='$edit_id'");
    	$ywww = $yw->fetch_assoc();
    	echo json_encode($ywww);
    }
?>