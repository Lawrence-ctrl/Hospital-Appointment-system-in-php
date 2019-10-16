<script type="text/javascript">
  $(document).ready(function(){
    $('#appointment_depart').on('change',function(){
      var department_id = $(this).val();
      if(department_id) {
        $.ajax({
          url : 'ajaxData.php',
          method : 'POST',
          data: {department_id:department_id},
          success: function(data){
            $('#appointment_doctor').html(data);
          }
        });
      }
    });
  });
  $(document).ready(function(){
    $('#appointment_doctor').on('change',function(){
      var doctor_id = $(this).val();
      if(doctor_id){
        $.ajax({
          url: 'ajaxData.php',
          method: 'POST',
          data: {doctor_id:doctor_id},
          success: function(data){
            $('#appointment_day').html(data);
          }
        });
      }
    });
  });
  $(document).ready(function(){
    $('#appoint').validate({
      rules: {
        patient_name : {
          required: true,
          minlength: 5
        },
        patient_email: {
          email: true,
          required: true
        },
        appointment_phone: {
          required: true,
          number: true,
          minlength: 8,
          maxlength: 13
        },
        patient_age: {
          required: true,
          number: true
        },
        appointment_depart: {
          required: true
        },
        appointment_doctor: {
          required: true
        },
        appointment_day: {
          required:true
        },
        adate: {
          required:true
        }
      }
    });
  });
</script>