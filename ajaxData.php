<?php
	include('database/connection.php');
	if(isset($_POST['department_id'])) {
		$department_id = $conn->real_escape_string($_POST['department_id']);
		$yes = $conn->query("SELECT * FROM doctors WHERE depid = '$department_id'");
		$yescount = $yes->num_rows;
		$output = '';
		if($yescount > 0){
			$output.='<option value="">--SELECT DOCTOR--</option>';
			while($yesyes = $yes->fetch_assoc()) {
				$output.= '<option value="'.$yesyes['doctors_id'].'">'.$yesyes['name'].'</option>';
			}
		}else{
			$output.= '<option value="">Doctor not available</option>';
		}
		echo $output;
	}elseif(isset($_POST['doctor_id'])) {
		$doctor_id = $conn->real_escape_string($_POST['doctor_id']);
		$hi = $conn->query("SELECT * FROM doctors WHERE doctors_id = '$doctor_id'");
		$hii = $hi->fetch_assoc();
		$hiii = $hii['day_id'];
		$no = $conn->query("SELECT * FROM dates WHERE dates_id IN ($hiii)");
		$nocount = $no->num_rows;
		$output = '';
		if($nocount > 0) {
			$output.= '<option value-"">--SELECT DAY--</option>';
			while($nono = $no->fetch_assoc()) {
				$output.= '<option value="'.$nono['dates_id'].'">'.$nono['datename'].'</option>';
			}
		}else{
				$output.= '<option value="">Day not available</option>';
		}
			echo $output;
	}
?>