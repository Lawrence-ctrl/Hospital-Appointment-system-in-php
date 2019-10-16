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
     
    <div class="hero-wrap" style="background-image: url('images/thesis_img/about.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>About</span></p>
            <h1 class="mb-3 bread">About Us</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section-2">
      <div class="container-fluid d-flex">
        <div class="section-2-blocks-wrapper row no-gutters">
          <div class="img col-sm-12 col-lg-6" style="background-image: url('images/about.jpg');">
           </div>
          <div class="text col-lg-6 ftco-animate">
            <div class="text-inner align-self-start">
              
              <h3>Welcome to Noble Clinic since 1898 established.</h3>
              <p>Welcome to Noble clinic, We will strive to provide exceptional care. We are committed to answering all your health care and medication needs as well as providing any practical advice. In addition. We will also offer specialized clinics and consultations. At Noble clinic, our focus is the well-being of you and your family. We are committed to providing a personalized customer service and welcome your suggestions on how we can make Noble clinic. Please visit us on our website. We look forward to meeting you.</p>
              <p>Primary health care is a whole-of-society approach to health and well-being centred on the needs and preferences of individuals, families and communities.  It addresses the broader determinants of health and focuses on the comprehensive and interrelated aspects of physical, mental and social health and wellbeing. </p>

            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Our Experienced Doctors</h2>
          </div>
        </div>
        <div class="row">
        	<div class="col-md-6 col-lg-3 ftco-animate">
	          <div class="block-2">
	            <div class="flipper">
	              <div class="front" style="background-image: url(images/doctor-1.jpg);">
	                <div class="box">
	                  <h2>Aldin Powell</h2>
	                  <p>Neurologist</p>
	                </div>
	              </div>
	              <div class="back">
	                <!-- back content -->
	                <blockquote>
	                  <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem&rdquo;</p>
	                </blockquote>
	                <div class="author d-flex">
	                  <div class="image mr-3 align-self-center">
	                    <div class="img" style="background-image: url(images/doctor-1.jpg);"></div>
	                  </div>
	                  <div class="name align-self-center">Aldin Powell <span class="position">Neurologist</span></div>
	                </div>
	              </div>
	            </div>
	          </div> <!-- .flip-container -->
	        </div>
	        <div class="col-md-6 col-lg-3 ftco-animate">
	          <div class="block-2">
	            <div class="flipper">
	              <div class="front" style="background-image: url(images/doctor-2.jpg);">
	                <div class="box">
	                  <h2>Aldin Powell</h2>
	                  <p>Pediatrician</p>
	                </div>
	              </div>
	              <div class="back">
	                <!-- back content -->
	                <blockquote>
	                  <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem&rdquo;</p>
	                </blockquote>
	                <div class="author d-flex">
	                  <div class="image mr-3 align-self-center">
	                    <div class="img" style="background-image: url(images/doctor-2.jpg);"></div>
	                  </div>
	                  <div class="name align-self-center">Aldin Powell <span class="position">Pediatrician</span></div>
	                </div>
	              </div>
	            </div>
	          </div> <!-- .flip-container -->
	        </div>
	        <div class="col-md-6 col-lg-3 ftco-animate">
	          <div class="block-2">
	            <div class="flipper">
	              <div class="front" style="background-image: url(images/doctor-3.jpg);">
	                <div class="box">
	                  <h2>Aldin Powell</h2>
	                  <p>Ophthalmologist</p>
	                </div>
	              </div>
	              <div class="back">
	                <!-- back content -->
	                <blockquote>
	                  <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem&rdquo;</p>
	                </blockquote>
	                <div class="author d-flex">
	                  <div class="image mr-3 align-self-center">
	                    <div class="img" style="background-image: url(images/doctor-3.jpg);"></div>
	                  </div>
	                  <div class="name align-self-center">Aldin Powell <span class="position">Ophthalmologist</span></div>
	                </div>
	              </div>
	            </div>
	          </div> <!-- .flip-container -->
	        </div>
	        <div class="col-md-6 col-lg-3 ftco-animate">
	          <div class="block-2">
	            <div class="flipper">
	              <div class="front" style="background-image: url(images/doctor-4.jpg);">
	                <div class="box">
	                  <h2>Aldin Powell</h2>
	                  <p>Pulmonologist</p>
	                </div>
	              </div>
	              <div class="back">
	                <!-- back content -->
	                <blockquote>
	                  <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem&rdquo;</p>
	                </blockquote>
	                <div class="author d-flex">
	                  <div class="image mr-3 align-self-center">
	                    <div class="img" style="background-image: url(images/doctor-4.jpg);"></div>
	                  </div>
	                  <div class="name align-self-center">Aldin Powell <span class="position">Pulmonologist</span></div>
	                </div>
	              </div>
	            </div>
	          </div> <!-- .flip-container -->
	        </div>
        </div>
        <div class="row">
        	<div class="col-md-9 ftco-animate">
        		<h4>We are well experienced doctors</h4>
        		<p>The treatment needed by many patients need cannot be packaged in a pill form. True treatment of the person involves so much more.</p>
        	</div>
        </div>
    	</div>
    </section>

    <section class="ftco-section-2 img" style="background-image: url(images/bg_3.jpg);">
    	<div class="container">
    		<div class="row d-md-flex justify-content-end">
    			<div class="col-md-6">
    				<div class="row">
    					<div class="col-md-12">
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>Laboratory Services</h2>
    							<p>This laboratory is 24/7 available. So many things you can be testing at there. </p>
    						</a>
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>General Treatment</h2>
    							<p>General treatment for patients are available in our clinic.</p>
    						</a>
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>Ultrasonography</h2>
    							<p>Eventhough ultrason services are not 24/7 but available on weekdays plus saturday from 4:00PM to 8:00PM.</p>
    						</a>
    						<a href="#" class="services-wrap ftco-animate">
    							<div class="icon d-flex justify-content-center align-items-center">
    								<span class="ion-ios-arrow-back"></span>
    								<span class="ion-ios-arrow-forward"></span>
    							</div>
    							<h2>Emergency Service</h2>
    							<p>Emergency service is available for 24/7.</p>
    						</a>
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
                <li class="ftco-animate"><a href="www.facebook.com"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
              	<li><a href="" class="py-2 d-block">Appointments</a></li>
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
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
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
            <form action="about.php" id="appoint" method="POST">
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
