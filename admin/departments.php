<?php 
  include('../database/connection.php');
  include('includes/header.php');
  include('auth.php'); 
  $depart = $conn->query("SELECT * FROM departments");
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
                <h4 class="card-title">Departments</h4>
             
                  <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDepartment">Add Department</a>


                  <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="exampleModalLabel">Add Department</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="addDepart" name="addDepart">
                               <input type="text" id="departname" name="departname" class="form-control text-secondary">
                               <input type="submit" class="btn btn-primary" value="Add">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
             <div class="modal fade" id="editDepartment" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title text-primary" id="editModalLabel">Edit Department</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDepart" name="editDepart">
                               <input type="text" id="editdepartname" name="editdepartname" class="form-control text-secondary">
                               <input type="hidden" name="hiddeneditid" id="hiddeneditid">
                               <input type="submit" class="btn btn-primary" value="Update">
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          
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
                           <td>Department Name</td>
                           <td>Action</td>
                        </tr>                      
                    </thead>
                    <tbody class="text-primary depart">
                        <?php foreach($depart as $key => $d) { ?>
                          <tr  id="nice<?php echo $d['departments_id']?>">
                             <td><?php echo $key+1 ?></td>
                             <td><?php echo $d['depname']; ?>
                             <td><i class="tim-icons icon-pencil text-success editer" id="<?php echo $d['departments_id']?>"></i> &nbsp; &nbsp;
                                 <i class="tim-icons icon-trash-simple text-danger trasher" id="<?php echo $d['departments_id']?>"></i>
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
           url: "deletedepartment.php",
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
       $(document).ready(function() {
        $('#addDepart').on('submit',function(event) {
               event.preventDefault();
          if($('#departname').val() != "") {
           $.ajax({
              url: "adddepart.php",
              method : "POST",
              dataType: "json",
              data : $(this).serialize(),
              success: function(data) {
                if(data.depname) {
                  location.reload();
                }else{
                  alert(data.error);
                  $('#addDepart')[0].reset();
                }
            }
           });
         }
        });
       });
     </script>
     <script type="text/javascript">
       $(document).ready(function() {
        $('.editer').on('click',function() {
          var edit_id = $(this).attr('id');
          $.ajax({
            url: "editdepart.php",
            method: "POST",
            dataType : "json",
            data: {edit_id:edit_id},
            success: function(data) {
              $('#editdepartname').val(data.depname);
              $('#hiddeneditid').val(data.departments_id);
              $('#editDepartment').modal('show');
            }
          });
        });
        $('#editDepart').on('submit',function(event) {
               event.preventDefault();
               if($('#editdepartname').val() != "") {
               $.ajax({
                url: "updatedepart.php",
                method: "POST",
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                       if(data.depname) {
                      location.reload();
                    }else{
                      alert(data.error);
                      $('#editDepart')[0].reset();
                    }
                }
               });
             }
        });
       });
    </script>
    
   