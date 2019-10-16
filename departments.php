<?php 
include('database/connection.php');
include('includes/userheader.php'); 
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';

      if(isset($_POST['appoint'])){
          date_default_timezone_set('Asia/Rangoon');
       $today = date('Y-m-d');
       $select = $conn->query("SELECT * FROM appointments WHERE date_id < '$today'");
       foreach ($select as $key => $value) {
         $insert = $conn->query("INSERT INTO history_appointments(history_patientname,history_email,history_phonenumber,history_age,history_department_id,history_doctor_id,history_day_id,history_date,created_at,updated_at) VALUES ('".$value['patientname']."','".$value['email']."','".$value['phonenumber']."','".$value['age']."','".$value['department_id']."','".$value['doctor_id']."','".$value['day_id']."','".$value['date_id']."',now(),now())");
       }
       if($select->num_rows > 0) {
        if($insert) {
       $yes = $conn->query("DELETE FROM appointments WHERE date_id < '$today'");
       $nice = $conn->query("DELETE FROM countt WHERE count_date < '$today'");
         }
       }
         $patient_name = $conn->real_escape_string($_POST['patient_name']);
         $patient_email = $conn->real_escape_string($_POST['patient_email']);
         $patient_phone = $conn->real_escape_string($_POST['appointment_phone']);
         $patient_age = $conn->real_escape_string($_POST['patient_age']);
         $department_id = $conn->real_escape_string($_POST['appointment_depart']);
         $doctor_id = $conn->real_escape_string($_POST['appointment_doctor']);
         $day_id = $conn->real_escape_string($_POST['appointment_day']);
         $date = $_POST['adate'];

          $mail = new PHPMailer;
          $mail->isSMTP();                                     
          $mail->Host = "smtp.gmail.com";  
          $mail->SMTPAuth = true;                             
          $mail->Username = 'takemehome19997@gmail.com';               
          $mail->Password = 'loveyadude1997';               
          $mail->SMTPSecure = 'ssl';                          
          $mail->Port = 465;                                   
          $mail->setFrom('takemehome19997@gmail.com','App');
          $mail->addAddress($patient_email);   
          $mail->addReplyTo('takemehome19997@gmail.com');
          $mail->isHTML(true); 
         $xo = $conn->query("SELECT * FROM appointments WHERE email='$patient_email' AND doctor_id='$doctor_id'");
         $zero = $xo->fetch_assoc();
         $dayzo = $zero['day_id'];
               if($dayzo == '1') {
                  $print = "Monday";
               }elseif($dayzo == '2'){
                  $print = "Tuesday";
               }elseif ($dayzo == '3') {
                 $print = "Wednesday";
               }elseif ($dayzo == '4') {
                 $print = "Thursday";
               }elseif($dayzo == '5') {
                $print = "Friday";
               }elseif($dayzo == '6') {
                $print = "Saturday";
               }else{
                $print = "Sunday";
               }
         $xoo = $conn->query("SELECT * FROM countt WHERE count_doctor_id = '$doctor_id' AND count_day_id = '$day_id' AND count_date='$date'");
          $zoo = $xoo->fetch_assoc();
         if($xo->num_rows > 0) 
         {
            $mail->Subject = 'Appointment';
                  $mail->Body    = '<b>Booking Failed. You are already in our "'.$zero['date_id'].'" ("'.$print.'" ) Booking List!</b><br>
                  <b>You can cancel your booking and rebook in another day by clicking this button. <a href="localhost/appointment/cancelbooking.php?do_id='.$doctor_id.'&&d_id='.$day_id.'&&email='.$patient_email.'&&date='.$zero['date_id'].'"><button>Cancel</button></a>';
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  if(!$mail->send()) {
                      echo 'Message could not be sent.';
                      echo 'Mailer Error: ' . $mail->ErrorInfo;
                  }else{
                      echo '<script>window.alert("Please check your GMAIL account")</script>';
                  }
         }else{ 
          if($zoo['count_hit'] < 3) {
            if($xoo->num_rows > 0){
                $count_hit = $zoo['count_hit']+1;
                $crazy = $conn->query("UPDATE countt SET count_hit = '$count_hit' WHERE count_doctor_id='$doctor_id' AND count_day_id = '$day_id' AND count_date = '$date'");
            }else{
              $count_hit = 1;
            $crazy = $conn->query("INSERT INTO countt(count_day_id, count_doctor_id,count_date,count_hit, created_date, updated_date) VALUES('$day_id','$doctor_id','$date','1',now(),now())");
            }
            if($crazy) {
            $nice = $conn->query("INSERT INTO appointments (patientname, email, phonenumber, age, department_id, doctor_id, day_id, date_id, created_at, updated_at ) VALUES ('$patient_name','$patient_email','$patient_phone','$patient_age','$department_id','$doctor_id','$day_id','$date',now(),now())");
               if($nice){
                   $mail->Subject = 'Appointment Success';
                  $mail->Body    = 'Your booking request is confirmed!<br>
                    Your token number is<br>
                    <center><b style="font-size:20px">'.$count_hit.'</b></center><br>
                  You can cancel your previous booking by clicking this button.<a href="localhost/appointment/cancelbooking.php?do_id='.$doctor_id.'&&d_id='.$day_id.'&&email='.$patient_email.'&&date='.$date.'"><button>Cancel</button></a>';
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  if(!$mail->send()) {
                      echo 'Message could not be sent.';
                      echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                      echo '<script>window.alert("Please check your GMAIL account")</script>';
                  }
               }
           }
            }else{
                  $mail->Subject = 'Appointment';
                  $mail->Body    = '<b style="color:red">Booking are full for . We allowed only 3 persons in a day.</b>';
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  if(!$mail->send()) {
                      echo 'Message could not be sent.';
                      echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                      echo '<script>window.alert("Please check your GMAIL account")</script>';
                  }
            }
         }
      }
?>
  <style type="text/css">
     .error {
        color:red;
     }
  </style>


<body>
<?php include('includes/usernavbar.php');?>

	<div class="hero-wrap" style="background-image: url('images/thesis_img/department.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Departments</span></p>
            <h1 class="mb-3 bread">Departments</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="department-single.php" class="img" style="background-image: url(images/dept-1.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="department-single.php">Dental Department</a></h3>
    						<p><span class="loc">203 Fake St. California, USA</span></p>
    						<p><span class="doc">2 Doctors</span></p>
    						<p>Dentistry, also known as Dental and Oral Medicine, is a branch of medicine that consists of the study, diagnosis, prevention, and treatment of diseases, disorders, and conditions of the oral cavity.</p>
    						<ul>
    							<li><span class="ion-ios-checkmark"></span>Emergency</li>
    							<li><span class="ion-ios-checkmark"></span>Laboratory</li>
    							<li><span class="ion-ios-checkmark"></span>Dental</li>
    						</ul>
    					</div>
    				</div>
    			</div>

    			<!-- surgical -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="department-surgical.php" class="img" style="background-image: url(images/thesis_img/surgical.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="department-surgical.php">Surgical Department</a></h3>  				


    						<p><span class="loc">203 Fake St. California, USA</span></p>
    						<p><span class="doc">2 Doctors</span></p>
    						<p>Surgery, whether elective or emergency, is done for many reasons. A patient may have surgery to: Further explore the condition for the purpose of diagnosis.</p>
    						<ul>
    							<li><span class="ion-ios-checkmark"></span>Emergency</li>
    							<li><span class="ion-ios-checkmark"></span>Laboratory</li>
    							<li><span class="ion-ios-checkmark"></span>Dental</li>
    						</ul>
    					</div>
    				</div>
    			</div>

    			<!-- ent -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="department-ent.php" class="img" style="background-image: url(images/thesis_img/entdep.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="department-ent.php">Ear Nose and Throat (ENT)</a></h3>
    						<p><span class="loc">203 Fake St. California, USA</span></p>
    						<p><span class="doc">3 Doctors</span></p>
    						<p>The ENT service aims to improve the quality of life for individuals with ear, nose and throat disorders, and provide timely and accurate advice and information. </p>
    						<ul>
    							<li><span class="ion-ios-checkmark"></span>Emergency</li>
    							<li><span class="ion-ios-checkmark"></span>Laboratory</li>
    							<li><span class="ion-ios-checkmark"></span>Dental</li>
    						</ul>
    					</div>
    				</div>
    			</div>

    			<!-- paediatric -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="department-paediatric.php" class="img" style="background-image: url(images/thesis_img/pediatrician.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="department-paediatric.php"> Paediatric </a></h3>
    						<p><span class="loc">203 Fake St. California, USA</span></p>
    						<p><span class="doc">2 Doctors</span></p>
    						<p>Pediatricsis the branch of medicine that involves the medical care of infants, children, and adolescents. </p>
    						<ul>
    							<li><span class="ion-ios-checkmark"></span>Emergency</li>
    							<li><span class="ion-ios-checkmark"></span>Laboratory</li>
    							<li><span class="ion-ios-checkmark"></span>Dental</li>
    						</ul>
    					</div>
    				</div>
    			</div>


    			<!--Neurological  -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="department-neurological.php" class="img" style="background-image: url(images/thesis_img/neurologydep.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="department-neurological.php">Neurological Department</a></h3>
    						<p><span class="loc">203 Fake St. California, USA</span></p>
    						<p><span class="doc">3 Doctors</span></p>
    						<p>Neurology is the branch of medicine concerned with the study and treatment of disorders of the nervous system. </p>
    						<ul>
    							<li><span class="ion-ios-checkmark"></span>Emergency</li>
    							<li><span class="ion-ios-checkmark"></span>Laboratory</li>
    							<li><span class="ion-ios-checkmark"></span>Dental</li>
    						</ul>
    					</div>
    				</div>
    			</div>

    			<!-- ophthalmological -->
    			<div class="col-lg-6 d-flex ftco-animate">
    				<div class="dept d-md-flex">
    					<a href="department-ophthalmological.php" class="img" style="background-image: url(images/dept-4.jpg);"></a>
    					<div class="text p-4">
    						<h3><a href="department-ophthalmological.php">Ophthalmological Department</a></h3>
    						<p><span class="loc">203 Fake St. California, USA</span></p>
    						<p><span class="doc">2 Doctors</span></p>
    						<p>Ophthalmology is a branch of medicine and surgery which deals with the diagnosis and treatment of eye disorders.</p>
    						<ul>
    							<li><span class="ion-ios-checkmark"></span>Emergency</li>
    							<li><span class="ion-ios-checkmark"></span>Laboratory</li>
    							<li><span class="ion-ios-checkmark"></span>Dental</li>
    						</ul>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>


	<!-- footer start -->
    <footer class="ftco-footer ftco-bg-dark ftco-section img" style="background-image: url(images/bg_5.jpg);">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Noble</h2>
              <p>The most valuable thing is your health</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
              	<li><a href="#" class="py-2 d-block">Appointments</a></li>
                <li><a href="#" class="py-2 d-block">Our Specialties</a></li>
                <li><a href="#" class="py-2 d-block">Why Choose us</a></li>
                <li><a href="#" class="py-2 d-block">Our Services</a></li>
                <li><a href="#" class="py-2 d-block">health Tips</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Site Links</h2>
              <ul class="list-unstyled">
                <li><a href="index.php" class="py-2 d-block">Home</a></li>
                <li><a href="about.php" class="py-2 d-block">About</a></li>
                <li><a href="departments.php" class="py-2 d-block">Departments</a></li>
                <li><a href="doctors.php" class="py-2 d-block">Doctors</a></li>
                <li><a href="contact.php" class="py-2 d-block">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href=""><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="www.gmail.com"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <!-- <p>Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
              Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.</p> -->
               <p> Developed with <i class="icon-heart" aria-hidden="true"></i> by Jacklin Htoo.</p>
          </div>
        </div>
      </div>
    </footer>
    <!-- footer end -->


    <!-- Modal -->
   <div class="modal fade" id="modalAppointment" tabindex="-1" role="dialog" aria-labelledby="modalAppointmentLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAppointmentLabel">Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="departments.php" id="appoint" method="POST">
              <div class="form-group">
                <label for="patient_name" class="text-black">Full Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name">
              </div>
              <div class="form-group">
                <label for="patient_email" class="text-black">Email</label>
                <input type="email" class="form-control" id="patient_email" name="patient_email">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="appointment_phone" class="text-black">Phone Number</label>
                    <input type="text" class="form-control" id="appointment_phone" name="appointment_phone">
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="patient_age" class="text-black">Age</label>
                    <input type="number" class="form-control" id="patient_age" name="patient_age">
                  </div>
                </div>
              </div>
              <div class="form-group">
                
              </div>
               <div class="form-group">
                <label for="appointment_depart" class="text-black">Select Department</label>
                <select name="appointment_depart" class="form-control" id="appointment_depart">
                  <option value=""> --SELECT DEPARTMENT--</option>
                  <?php $doc = $conn->query("SELECT * FROM departments ORDER BY departments_id ASC");
                     while($docu = $doc->fetch_assoc()) : ?>
                      <option value="<?php echo $docu['departments_id']?>"><?php echo $docu['depname']?></option>
                    <?php endwhile; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="appointment_doctor" class="text-black">Select Doctor</label>
                <select name="appointment_doctor" class="form-control" id="appointment_doctor">
                  <option value="">--SELECT DOCTOR--</option>  
                </select>
              </div>
              <div class="form-group">
                <label for="appointment_day" class="text-black">Select Day</label>
                <select name="appointment_day" class="form-control" id="appointment_day">
                  <option value="">--SELECT DAY--</option>  
                </select>
              </div>

                  <div class="form-group">
                    <label for="adate" class="text-black">Date</label>
                    <input type="text" class="form-control" name="adate" id="adate">
                  </div>  
              
              <div class="form-group">
                <input type="submit" value="Appoint" class="btn btn-primary" name="appoint">
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>
    <!-- model end -->


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="js/jquery.validate.min.js"></script>
 <!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </body>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#adate').datepicker({
      minDate: 0, 
      maxDate: '+1M',
      dateFormat: 'yy-mm-dd',
       beforeShowDay: function(date)
       {
        var fromdb = $('#appointment_day').val();
        if(fromdb == 7) {
         var fromdb = 0;
        }
        var day= date.getDay();
        if(day == fromdb){
          return [true];
        }else{
          return [false];
        }
       }
    });
  });
</script>
<?php include('includes/footer.php');?>