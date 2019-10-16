<?php 
  include('../database/connection.php');
  include('includes/header.php'); 
  include('auth.php');
     if(isset($_POST['change'])) {
        $doctor_id = $conn->real_escape_string($_POST['doctor']);
        $si = $conn->query("SELECT a.*,de.*,d.*,da.* FROM history_appointments as a LEFT JOIN departments as de ON a.history_department_id = de.departments_id LEFT JOIN doctors as d ON a.history_doctor_id = d.doctors_id LEFT JOIN dates as da ON a.history_day_id = da.dates_id WHERE a.history_doctor_id = '$doctor_id'");
     }else{
      $doctor_id = 1;
       $si = $conn->query("SELECT a.*,de.*,d.*,da.* FROM history_appointments as a LEFT JOIN departments as de ON a.history_department_id = de.departments_id LEFT JOIN doctors as d ON a.history_doctor_id = d.doctors_id LEFT JOIN dates as da ON a.history_day_id = da.dates_id WHERE a.history_doctor_id = '$doctor_id'");
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
                <h4 class="card-title">Appointments' History</h4>
                <div class="text-right">
                <form action="history.php" method="POST">
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
                           <td><?php echo $wu['history_patientname'] ?></td>
                           <td><?php echo $wu['history_email'] ?></td>
                           <td><?php echo $wu['history_phonenumber'] ?></td>
                           <td><?php echo $wu['history_age'] ?></td>
                           <td><?php echo $wu['depname'] ?></td>
                           <td><?php echo $wu['datename']?></td>
                           <td><?php echo $wu['history_date']?></td>
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
   