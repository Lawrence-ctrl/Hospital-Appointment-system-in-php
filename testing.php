<?php 
include('database/connection.php');
$doctor_id = 1;
   $hi = $conn->query("SELECT * FROM doctors WHERE doctors_id = '$doctor_id'");
		$hii = $hi->fetch_assoc();
		$hiii = $hii['day_id'];
		$no = $conn->query("SELECT * FROM dates WHERE dates_id IN ($hiii)");
		foreach ($no as $array){
		print_r($array);
	}
?>

