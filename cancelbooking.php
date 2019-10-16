<?php 
	include('database/connection.php');
	if(isset($_GET['d_id']) && isset($_GET['do_id']) && isset($_GET['email']) && isset($_GET['date'])) 
	{
		$doctor_id = $conn->real_escape_string($_GET['do_id']);
		$day_id = $conn->real_escape_string($_GET['d_id']);
		$email = $conn->real_escape_string($_GET['email']);
		$date = $conn->real_escape_string($_GET['date']);
		$delete = $conn->query("DELETE FROM appointments WHERE doctor_id='$doctor_id' AND day_id='$day_id' AND email = '$email' AND date_id= '$date'");
		if($delete)
		{
			$query = $conn->query("SELECT * FROM countt WHERE count_doctor_id = '$doctor_id' AND count_day_id='$day_id' AND count_date = '$date'");
			$fetch_query = $query->fetch_assoc();
			$count_query = $fetch_query['count_hit'];
			if($query->num_rows > 0) 
			{
				if($count_query == 1) 
				{
					$end = $conn->query("DELETE FROM countt WHERE count_doctor_id='$doctor_id' AND count_day_id='$day_id' AND count_date='$date'");
				}else
				{
					$minus_count = $count_query-1;
					$end = $conn->query("UPDATE countt SET count_hit='$minus_count' WHERE count_doctor_id='$doctor_id' AND count_day_id='$day_id' AND count_date='$date'");
				}
					if($end)
						{
							echo "<script>
					      	window.location.href = 'index.php';
					      	window.alert('Your booking request is successfully cancelled!');
					      	</script>";
						}
			}
		}
	}
?>