<?php 
  include('../database/connection.php');
  include('includes/header.php'); 
  include('auth.php');
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
     if(isset($_POST['change'])) {
        $doctor_id = $conn->real_escape_string($_POST['doctor']);
        $si = $conn->query("SELECT a.*,de.*,d.*,da.* FROM appointments as a LEFT JOIN departments as de ON a.department_id = de.departments_id LEFT JOIN doctors as d ON a.doctor_id = d.doctors_id LEFT JOIN dates as da ON a.day_id = da.dates_id WHERE a.doctor_id = '$doctor_id'");
     }else{
      $doctor_id = 1;
       $si = $conn->query("SELECT a.*,de.*,d.*,da.* FROM appointments as a LEFT JOIN departments as de ON a.department_id = de.departments_id LEFT JOIN doctors as d ON a.doctor_id = d.doctors_id LEFT JOIN dates as da ON a.day_id = da.dates_id WHERE a.doctor_id = '$doctor_id'");
     }
?>
<body class=" ">
  <div class="wrapper ">
   <?php include('includes/sidebar.php');?>
    <div class="main-panel">
      <!-- Navbar -->
     <?php include('includes/navbar.php'); ?>
      <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title">Appointments</h4>
                <div class="text-right">
                <form action="index.php" method="POST">
                <select name="doctor" class="form-control text-center text-secondary">
                   <?php $doctor = $conn->query("SELECT * FROM doctors"); 
                    foreach ($doctor as $row) { 
                      echo '<option value="'.$row['doctors_id'].'"
                      '.(($row['doctors_id'] == $doctor_id)?'selected="selected"':'').'>'.$row['name'].'</option>';
                     } ?>
                 </select>
                 <input type="submit" name="change" class="btn btn-primary btn-sm" value="Change">
               </form>
               </div>
              </div>
            
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>No.</td>
                           <td>Name</td>
                           <td>Email</td>
                           <td>Phone Number</td>
                           <td>Age</td>
                           <td>Department</td>
                           <td>Day</td>
                           <td>Date</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary">
                       <?php 
                       foreach ($si as $key => $wu) { ?>
                       <tr>
                           <td><?php echo $key+1 ?></td>
                           <td><?php echo $wu['patientname'] ?></td>
                           <td><?php echo $wu['email'] ?></td>
                           <td><?php echo $wu['phonenumber'] ?></td>
                           <td><?php echo $wu['age'] ?></td>
                           <td><?php echo $wu['depname'] ?></td>
                           <td><?php echo $wu['datename']?></td>
                           <td><?php echo $wu['date_id']?></td>
                       </tr>
                     <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      </div>
    </div>
     
    <?php include('includes/fixedplugin.php');
          include('includes/footer.php'); ?>
    <!--   Core JS Files   -->
   