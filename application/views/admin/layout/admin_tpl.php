<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/layout/head') ?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php $this->load->view('admin/layout/left_bar') ?>

            <!-- top navigation -->
            <div class="top_nav">
                <?php $this->load->view('admin/layout/header'); ?>
            </div>
            <!-- /top navigation -->
            <div class="clearfix"></div>
            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 900px;">
                <!-- page view content -->
                <?php echo $contents;?>
                <!-- page view content -->
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <a href="">PSL</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="<?php echo ADMIN_JS_PATH;?>/jquery.min.js"></script>
    <script src="<?php echo ADMIN_JS_PATH ?>/tiny_mce/jquery.tinymce.min.js" type="text/javascript"></script>
    <script src="<?php echo ADMIN_JS_PATH ?>/tiny_mce/tinymce.js" type="text/javascript"></script> 
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_JS_PATH;?>/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_JS_PATH;?>/custom.min.js"></script>    
    <script src="<?php echo ADMIN_JS_PATH;?>/admin.min.js"></script>    
    <script src="<?php echo ADMIN_JS_PATH;?>/jquery.dataTables.min.js"></script>    
    <script>
            $(document).ready(function() {


              $('[id^=edit_score]').click(function(){
                $('[id^=score_]').attr('readonly','readonly');
                $('[id^=submitscore_]').hide();
                $('[id^=edit_score]').show();
                $(this).hide();
                $('#score_'+$(this).attr('row_id')).removeAttr('readonly');
                $('#submitscore_'+$(this).attr('row_id')).show();
              });

              $('#psl_score_day').change(function(){
                newday = $('#psl_score_day').val();
                url = window.location.href.split('?')[0];
                newurl = url+'?day='+newday;
                window.location.href = newurl;
              });

              $($('[id^=submitscore_]')).click(function(){

                row_id = $(this).attr('row_id');
                score = $('#score_'+row_id).val();
                if(score.trim()=='')
                {
                  alert('Score can not be empty');
                }else if(!$.isNumeric(score))
               	{
                	alert("Please enter valid score");
               	}else if(score<0)
        				{
        					alert("Score can not be negative");
        				}
                else
                {
                  $.ajax({
                    url: '/admin/fantasy/updateUserScore/'+row_id+'/'+score,
                    success: function(response) {
                      response = JSON.parse(response);
                      if(response.status == 'true'){
                        $('[id^=score_]').attr('readonly','readonly');
                        alert('Score updated successfully');
                        $('#submitscore_'+row_id).hide();
                        $('#edit_score_'+row_id).show();
                      }else{
                        alert('something went wrong!');
                      }

                      }
                  });
                }
              });

              $($('[id^=player_status_]')).click(function(){

                row_id = $(this).attr('row_id');
                status = $(this).attr('row_status');
                $.ajax({
                  url: '/admin/fantasy/updatePlayerStatus/'+row_id+'/'+status,
                  success: function(response) {
                    response = JSON.parse(response); 
                    if(response.status == 'true'){
                      if(status == 1 ){
                        alert('Status updated successfully');
                        $('#player_status_'+row_id).text('Active');
                        $('#player_status_'+row_id).attr('row_status',0);
                      }else if(status == 0){
                        $('#player_status_'+row_id).text('Insctive');
                        $('#player_status_'+row_id).attr('row_status',1);
                      }
                    }else{
                      alert('Something went wrong');
                    }
                  }
                });
              });

                $('.notification-div').hide();
                <?php if($this->session->flashdata('msg')){ ?>
                $('.notification-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();
                <?php } ?>
                 $('#exportTable').dataTable({});
                });
            
   <?php if($this->uri->segment(3) == 'manageUsers'){ ?>   
  function changeStatus(user_id,doc_status)
  {
    $('.container').before('<div id="dimScreen"><div class="loader">Loading...</div></div>');
    $.get("/admin/dashboard/updateUserDocStatus?user_id="+user_id+"&status="+doc_status, function(data, status){
      var resp = $.trim(data);
        if(resp=='ALREADY_DONE')
        {
          alert("Status Changed Already.");
          location.reload();
        }
        else if(resp == 'SOMETHING_WENT_WRONG')
          alert("Something Went Wrong. Please Try After Sometime.");
        else
        {
        	
          $('.btn_'+user_id).remove();
          $('#td_'+user_id).text(doc_status);
          location.reload();
        }
        $('#dimScreen').remove();
    });
  }

  function closeModal()
  {
    $('#myModalNorm').modal('hide');
    location.reload();
  } 


  function downloadExcel(){
    window.location = 'downloadExcel?username='+$( "input[name='username']" ).val()+'&state='+$( "input[name='state']" ).val()+'&status='+$( "input[name='status']" ).val();
  }
  <?php } ?>
<?php if($this->uri->segment(3) == 'addQualifier'){?>
  $('#get_user').click(function(){
    if($( "input[name='user_name']" ).val() != '' && $( "input[name='user_name']" ).val() != undefined){
      $('.text-danger').html('');

                $.ajax({
                   url: "getUser/"+$( "input[name='user_name']" ).val()+'/'+$( "select[name='category_id']" ).val(),
                   type: 'GET',
                   success: function(res) {
                       response = JSON.parse(res);
                       if(response.status ==true){
                           $( "input[name='user_id']" ).val(response.data.user_id);
                           $('#get_user').next().removeClass('text-danger');
                           $('#get_user').next().addClass('text-success');
                           $('#get_user').next().html(response.message);
                       }else{
                        $( "input[name='user_id']" ).val('');
                          $('#get_user').next().removeClass('text-success');
                          $('#get_user').next().addClass('text-danger');
                          $('#get_user').next().html(response.message);
                       }
                   }
               });
            }
         })
  <?php } ?>
    </script>
</body>

</html>
