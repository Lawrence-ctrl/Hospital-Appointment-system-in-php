<?php 
include('database/connection.php');
include('includes/userheader.php'); 
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';
    $doctor =  $conn->query("SELECT de.*,d.* FROM doctors as d LEFT JOIN departments as de ON d.depid = de.departments_id");
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
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html"><i class="flaticon-pharmacy"></i><span>Re</span>Medic</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item"><a href="departments.php" class="nav-link">Departments</a></li>
          <li class="nav-item active"><a href="doctors.php" class="nav-link">Doctors</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
          <li class="nav-item cta"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalAppointment"><span>Make an Appointment</span></a></li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bg_6.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Doctor</span></p>
            <h1 class="mb-3 bread">Well Experienced Doctors</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
           <div class="table-responsive">
                  <table class="table table-striped text-info" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>No.</td>
                           <td>Doctor Name</td>
                           <td>Degree</td>
                           <td>Department</td>
                           <td width="220px">Sitting Time</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary depart">
                        <?php foreach($doctor as $key => $d) { ?>
                          <tr id="nice<?php echo $d['doctors_id']?>">
                             <td><?php echo $key+1 ?></td>
                             <td><?php echo $d['name']; ?></td>
                             <td><?php echo $d['degree']; ?></td>
                             <td><?php echo $d['depname']; ?></td>
                             <td width="220px"><?php echo $d['sitting_time'];?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
        </div>
    
      </div>
    </section>
    




  <footer class="ftco-footer ftco-bg-dark ftco-section img" style="background-image: url(images/bg_5.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Noble</h2>
              <p>The most valuabe thing is your health</p>
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
          </div>
        </div>
      </div>
    </footer> 

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

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
            <form action="doctors.php" id="appoint" method="POST">
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
  <<!-- script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="admin/datatables/jquery.dataTables.min.js"></script>
  <script src="admin/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="admin/datatables/datatables-demo.js"></script>
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
