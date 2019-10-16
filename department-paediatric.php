<?php 
include('database/connection.php');
include('includes/userheader.php'); 
?>


<body>
<?php include('includes/usernavbar.php');?>


<div class="hero-wrap" style="background-image: url('images/bg_6.jpg'); background-attachment:fixed;">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="departments.php">Departments</a></span> <span>Department Single</span></p>
            <h1 class="mb-3 bread">Paediatric Department</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
            <p>
              <img src="images/thesis_img/pediatrician.jpg" alt="" class="img-fluid">
            </p>
            <h2 class="mb-3">Paediatric Department</h2>
            <p>Paediatrics can be divided into 4 main areas:

            general paediatrics - a hospital role covering children from birth to the age of 16. Most paediatricians have this generalist role
            neonatology - this role specialises in looking after newly born babies. It is usually based in an intensive care unit looking after premature babies or those with problems at birth
            community paediatrics - these doctors are based in the community and look after children with developmental, social or behavioural problems and those with a physical disability
            paediatric cardiology - this is a small area which is a specialty in its own right. These doctors diagnose and treat children with cardiac (heart) conditions
            Pediatrics (also spelled paediatrics or pædiatrics) is the branch of medicine that involves the medical care of infants, children, and adolescents. The American Academy of Pediatrics recommends people be under pediatric care up to the age of 21, thought usually only minors under 18 are required to be under pediatric care. A medical doctor who specializes in this area is known as a pediatrician, or paediatrician. Pediatricians work both in hospitals, particularly those working in its subspecialties such as neonatology, and as outpatient primary care physicians.</p>
            
            <div class="about-author d-flex p-4 mt-5 mb-5 bg-light">
              <div class="bio align-self-md-center mr-5">
                <img src="images/thesis_img/ped1.jpg" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc align-self-md-center">
                <h3>Dr. Khloe</h3>
                <span class="position d-block mb-4">Head Doctor of paediatric's Dept</span>
                <p>If your child is born with a port-wine stain, they should be seen immediately by a pediatric dermatologist. Your pediatrician does not understand these birthmarks as well as a specialist.</p>
              </div>
            </div>

            <div class="row justify-content-start mb-5 pb-3 mt-5">
                <div class="col-md-12 heading-section ftco-animate">
                  <h2 class="mb-4">Our Experienced Doctors</h2>
                </div>
              </div>
            <div class="row">
               <div class="col-md-6 ftco-animate">
                   <div class="block-2">
                     <div class="flipper">
                       <div class="front" style="background-image: url(images/thesis_img/ped1.jpg);">
                         <div class="box">
                           <h2>Dr. Khloe</h2>
                           <p>Pediatrician</p>
                         </div>
                       </div>
                       <div class="back">
                         <!-- back content -->
                         <blockquote>
                           <p>&ldquo;If your child is born with a port-wine stain, they should be seen immediately by a pediatric dermatologist. Your pediatrician does not understand these birthmarks as well as a specialist.&rdquo;</p>
                         </blockquote>
                         <div class="author d-flex">
                           <div class="image mr-3 align-self-center">
                             <div class="img" style="background-image: url(images/thesis_img/ped1.jpg);"></div>
                           </div>
                           <div class="name align-self-center">Dr. Khloe <span class="position">Pediatrician</span></div>
                         </div>
                       </div>
                     </div>
                   </div> <!-- .flip-container -->
                 </div>
                 <div class="col-md-6 ftco-animate">
                   <div class="block-2">
                     <div class="flipper">
                       <div class="front" style="background-image: url(images/thesis_img/ped2.jpg);">
                         <div class="box">
                           <h2>Dr. Linnett</h2>
                           <p>Pediatrician</p>
                         </div>
                       </div>
                       <div class="back">
                         <!-- back content -->
                         <blockquote>
                           <p>&ldquo;If your child is born with a port-wine stain, they should be seen immediately by a pediatric dermatologist. Your pediatrician does not understand these birthmarks as well as a specialist. Hannah Storm&rdquo;</p>
                         </blockquote>
                         <div class="author d-flex">
                           <div class="image mr-3 align-self-center">
                             <div class="img" style="background-image: url(images/thesis_img/ped2.jpg);"></div>
                           </div>
                           <div class="name align-self-center">Dr. Linnett <span class="position">Pediatrician</span></div>
                         </div>
                       </div>
                     </div>
                   </div> <!-- .flip-container -->
                 </div>
            </div>

          </div> <!-- .col-md-8 -->
         <div class="col-md-4 sidebar ftco-animate">
            <!-- <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div> -->
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Categories</h3>
                <li><a href="departments.php">Departments <span>(6)</span></a></li>
                <li><a href="doctors.php">Doctors <span>(22)</span></a></li>
                <li><a href="#">Medicine <span>(37)</span></a></li>
                <li><a href="#">Hospital <span>(42)</span></a></li>
                <li><a href="#">Cure <span>(14)</span></a></li>
                <li><a href="#">Health <span>(140)</span></a></li>
              </div>
            </div>

           

            <div class="sidebar-box ftco-animate">
              <h3>Tag Cloud</h3>
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">medical</a>
                <a href="#" class="tag-cloud-link">cure</a>
                <a href="#" class="tag-cloud-link">remedy</a>
                <a href="#" class="tag-cloud-link">health</a>
                <a href="#" class="tag-cloud-link">workout</a>
                <a href="#" class="tag-cloud-link">medicine</a>
                <a href="#" class="tag-cloud-link">doctor</a>
                <a href="#" class="tag-cloud-link">medic</a>
              </div>
            </div>

            
          </div>

        </div>
      </div>
    </section> <!-- .section -->


    <!-- footer start -->
    <footer class="ftco-footer ftco-bg-dark ftco-section img" style="background-image: url(images/bg_5.jpg);">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Noble</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="https://www.facebook.com"><span class="icon-facebook"></span></a></li>
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
            <form action="index.php" id="appoint" method="POST">
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
                    <label for="appointment_date" class="text-black">Date</label>
                    <input type="date" class="form-control" name="appointment_date">
                  </div>    
              
              <div class="form-group">
                <input type="submit" value="Register" class="btn btn-primary" name="appoint">
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

</body>