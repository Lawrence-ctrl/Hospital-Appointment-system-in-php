<?php 
  include('../database/connection.php');
  include('auth.php');
  $error = ""; ;
    if(isset($_POST['departname'])) {
    	$departname = $conn->real_escape_string($_POST['departname']);
    	$woo = $conn->query("SELECT * FROM departments WHERE depname ='$departname'");
    	if($woo->num_rows > 0) {
    		$error = "Name alreay exists";
    		$output = array('error' => $error);
    		echo json_encode($output);
    	}else{
    	$nc = $conn->query("INSERT INTO departments (depname,created_at,updated_at) VALUES ('$departname',now(),now())");
    	if($nc) {
    		$output = array('depname' => $departname);
    		echo json_encode($output);
    	}
       }
    }
?>