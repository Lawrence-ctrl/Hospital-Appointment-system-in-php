<?php 
  include('../database/connection.php');
  include('auth.php');
  $error = "";
      if(isset($_POST['hiddeneditid'])) {
    	$edit_id = $_POST['hiddeneditid'];
    	$depname = $conn->real_escape_string($_POST['editdepartname']);
    	$woo = $conn->query("SELECT * FROM departments WHERE depname = '$depname'");
    	if($woo->num_rows > 0) {
    		$error = "Name alreay exists";
    		$output = array('error' => $error);
    		echo json_encode($output);
    	}else{
    	$change = $conn->query("UPDATE departments SET depname='$depname' WHERE departments_id='$edit_id'");
    	if($change) {
    	  $output = array('depname'=>$depname);
    	  echo json_encode($output);
    	}
    }
}
?>