<?php 
  include('../database/connection.php');
  include('includes/header.php'); 
  include('auth.php');
  $doctor =  $conn->query("SELECT de.*,d.*,da.* FROM doctors as d LEFT JOIN departments as de ON d.depid = de.departments_id LEFT JOIN  dates as da ON d.day_id = da.dates_id");
  $department = $conn->query("SELECT * FROM departments");
  $output = "";
  $date = $conn->query("SELECT * FROM dates");
  $errMsg = $erMsg = "";
     if(isset($_POST['add'])) {
       $doctorname = $conn->real_escape_string($_POST['doctorname']);
       $degree = $conn->real_escape_string($_POST['doctordegree']);
       $department_id = $conn->real_escape_string($_POST['doctordepartment']);
       $sitting_time = $conn->real_escape_string($_POST['sitting_time']);
       if(empty($_POST['doctorday'])) {
        $errMsg = "Day Field cannot be blank;";
       }else{
       $day_id = $_POST['doctorday'];
        $days = implode(',',$day_id);
       }
      
       if(empty($errMsg)) {
       $yes = $conn->query("INSERT INTO doctors(depid,name,degree,sitting_time,day_id,created_at,updated_at) VALUES ('$department_id','$doctorname','$degree','$sitting_time','$days',now(),now())");
         if($yes) {
          header("location:doctors.php?succ");
         }
       }
     }
     if(isset($_POST['update'])) {
      $edit_id = $conn->real_escape_string($_POST['hiddeneditid']);
       $doctorname = $conn->real_escape_string($_POST['editdoctorname']);
       $degree = $conn->real_escape_string($_POST['editdoctordegree']);
       $department_id = $conn->real_escape_string($_POST['editdoctordepartment']);
       $sitting_time = $conn->real_escape_string($_POST['editsittingtime']);
        if(empty($_POST['editdoctorday'])) {
        $erMsg = "Day Field cannot be blank;";
       }else{
       $day_id = $_POST['editdoctorday'];
        $days = implode(',',$day_id);
       }
      
       if(empty($erMsg)) {
       $yes = $conn->query("UPDATE doctors SET depid='$department_id',name='$doctorname',degree='$degree',sitting_time='$sitting_time',day_id='$days' WHERE doctors_id = '$edit_id'");
         if($yes) {
          header("location:doctors.php?update");
         }
       }
     }
?>
<style type="text/css">
  label#doctorname-error.error,label#doctordegree-error.error,label#doctordepartment-error.error,label#doctorday-error.error,label#sitting_time-error.error,label#editdoctorname-error.error,label#editdoctordegree-error.error,label#editdoctordepartment-error.error,label#editdoctorday-error.error {
    color:red;
  }
</style>
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
                <h4 class="card-title">Doctors</h4>
                <?php if(isset($_GET['succ'])) { ?>
                    <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Success - </b> Added Successfully!</span>
                </div>
              <?php } ?>
                  <?php if(isset($_GET['update'])) { ?>
                    <div class="alert alert-success">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Success - </b> Updated Successfully!</span>
                </div>
              <?php } ?>
               <?php if($erMsg) { ?>
                    <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Danger - </b> <?php echo $erMsg; ?>!</span>
                </div>
              <?php } ?>
                  <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDoctor">Add Doctor</a>


                  <div class="modal fade" id="addDoctor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="exampleModalLabel">Add Doctor</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="addDear" name="addDoctor" class="text-primary" method="POST">
                                   <?php if($errMsg) { ?>
                    <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Danger - </b> <?php echo $errMsg; ?>!</span>
                </div>
              <?php } ?>
                               Name:<input type="text" id="doctorname" name="doctorname" class="form-control text-secondary">
                               Degree:<input type="text" id="doctordegree" name="doctordegree" class="form-control text-secondary">
                               Department:<select name="doctordepartment" id="doctordepartment" class="form-control text-secondary">
                                <option value="">--Select Department--</option>
                               <?php foreach ($department as $depa) { ?> 
                                  <option value="<?php echo $depa['departments_id']?>"><?php echo $depa['depname']?></option>
                               <?php } ?>
                             </select>
                                Day:<select name="doctorday[]" multiple="multiple" id="doctorday" class="form-control text-secondary">

                               <?php foreach ($date as $dep) { ?> 
                                  <option value="<?php echo $dep['dates_id']?>"><?php echo $dep['datename']?></option>
                               <?php } ?>
                             </select>
                             Sitting Time<textarea name="sitting_time" class="form-control text-secondary"></textarea>
                               <input type="submit" class="btn btn-primary" name="add" value="Add">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                   <div class="modal fade" id="editDoctor" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="editModalLabel">Add Doctor</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDear" name="editDear" class="text-primary" method="POST">
                                   <?php if($erMsg) { ?>
                    <div class="alert alert-danger">
                  <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="tim-icons icon-simple-remove"></i>
                  </button>
                  <span>
                    <b> Danger - </b> <?php echo $erMsg; ?>!</span>
                </div>
              <?php } ?>
                              <input type="hidden" name="hiddeneditid" id="hiddeneditid">
                               Name:<input type="text" id="editdoctorname" name="editdoctorname" class="form-control text-secondary">
                               Degree:<input type="text" id="editdoctordegree" name="editdoctordegree" class="form-control text-secondary">
                               Department:<select name="editdoctordepartment" id="editdoctordepartment" class="form-control text-secondary">
                                <option value="">--Select Department--</option>
                               <?php foreach ($department as $depa) { ?> 
                                  <option value="<?php echo $depa['departments_id']?>"><?php echo $depa['depname']?></option>
                               <?php } ?>
                             </select>
                                Day:<select name="editdoctorday[]" multiple="multiple" id="editdoctorday" class="form-control text-secondary">
                               <?php foreach ($date as $dep) { ?> 
                                  <option value="<?php echo $dep['dates_id']?>"><?php echo $dep['datename']?></option>
                               <?php } ?>
                             </select>
                             <textarea name="editsittingtime" id="editsittingtime" class="form-control text-secondary"></textarea>
                               <input type="submit" class="btn btn-primary" name="update" value="Update">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-primary">
                        <tr>
                           <td>No.</td>
                           <td>Doctor Name</td>
                           <td>Degree</td>
                           <td>Department</td>
                           <td>Day</td>
                           <td>Time</td>
                           <td>Action</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary depart">
                        <?php foreach($doctor as $key => $d) {
                             $day = $d['day_id'];
                             $yes = $conn->query("SELECT * FROM dates WHERE dates_id IN ($day)");
                             
                                 
                         ?>
                          <tr id="nice<?php echo $d['doctors_id']?>">
                             <td><?php echo $key+1 ?></td>
                             <td><?php echo $d['name']; ?></td>
                             <td><?php echo $d['degree']; ?></td>
                             <td><?php echo $d['depname']; ?></td>
                            <td>  
                           <?php foreach ($yes as $great) { 
                                  $string = explode(',',$great['datename']);
                                  $array = implode(' ',$string);
                                echo ($array.'<br>'); 
                              } ?>
                                  
                               </td>
                             <td><?php echo $d['sitting_time']?></td>
                              <td><i class="tim-icons icon-pencil text-success editer" id="<?php echo $d['doctors_id']?>"></i> &nbsp; &nbsp;
                                 <i class="tim-icons icon-trash-simple text-danger trasher" id="<?php echo $d['doctors_id']?>">
                                 </i>
                               </td>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('#addDear').validate({
          rules: {
            doctorname: {
              required: true,
            },
            doctordegree: {
              required: true
            },
            doctordepartment: {
              required: true
            },
            sitting_time: {
              required: true
            },
              doctorday: {
              required: true
            }
          },
          messages: {
            
          }
      });
    });
</script>
 <script type="text/javascript">
    $(document).ready(function(){
      $('#editDear').validate({
          rules: {
            editdoctorname: {
              required: true,
            },
            editdoctordegree: {
              required: true
            },
            editdoctordepartment: {
              required: true
            },
            editdoctorday: {
              required: true
            }
          },
          messages: {
            
          }
      });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.trasher').on('click', function() {
        var trash_id = $(this).attr('id');
            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
        $.ajax({
           url: "deletedoctor.php",
           method: "POST",
           data: {trash_id:trash_id},
           success: function() {
            $('#nice'+trash_id).css({'background': 'tomato'});
            $('#nice'+trash_id).fadeTo('slow',0.7,function(){
              $(this).remove();
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              });
            }
        });
         }else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  'Cancelled',
                  'Your imaginary file is safe :)',
                  'error'
                )
              }
            });
      });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.editer').on('click',function() {
          var edit_id = $(this).attr('id');
          $.ajax({
            url: "editdoctor.php",
            method: "POST",
            dataType : "json",
            data: {edit_id:edit_id},
            success: function(data) {
              $('#editdoctorname').val(data.name);
              $('#editdoctordegree').val(data.degree);
              $('#editsittingtime').val(data.sitting_time);
              var string = data.day_id;
              var array = string.split(',');
              $('#editdoctordepartment').val(data.depid);
              $('#editdoctorday').val(array);
              $('#hiddeneditid').val(data.doctors_id);
              $('#editDoctor').modal('show');
            }
          });
        });
    });
</script>

 
   