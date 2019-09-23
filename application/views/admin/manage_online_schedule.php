<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    table {
    width: 100%;
    border-collapse: separate;
    padding: 0 50px 0 50px;
    text-align: center;
    color: #003d71; font-size: 14px;
}
table th{text-align: center; padding: 10px 0;font-size: 16px;}
table .btn{padding: 5px 20px;margin-top: 5px;}
.tpHeading{color: #004b8c;font-weight: 600;}
</style>
 <?php $this->load->view('admin/head') ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php $this->load->view('admin/left_bar') ?>

        <!-- top navigation -->
        <div class="top_nav">
         <?php $this->load->view('admin/header'); ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row">
            <h1 class="tpHeading">PSL Online Schedule</h1>
          </div>
          <?php if($_GET['msg'] == 'succ'){echo 'Deleted Successfully tourney';}?>
          <!-- /top tiles -->
          <table border="1" cellspacing="5" cellpadding="5" style="border-collapse: collapse;" >
          <tr><th>Tourney Name</th><th>Date</th><th>Time</th><th>Entry Criteria</th><th>Winnings</th><th>Edit</th><th>Action</th></tr>
          <?php 
          foreach($schedule_info as $row){
            echo '<tr><td>'.$row['tourney_name'].'</td><td>'.$row['date'].'</td><td>'.$row['time'].'</td><td>'.$row['entry_criteria'].'</td><td>'.$row['winnings'].'</td><td>';
            ?>

            <button class="btn btn-primary" data-toggle="modal" onclick="showModalWithData(<?php echo $row['id']; ?>);" >Edit</button></td>
            <td><button class="btn btn-primary" onclick="deleteTournament(<?php echo $row['id']; ?>);" >Delete</button></td></tr>
<?php
          }
          ?>
          </table>
        </div>
        <!-- /page content   data-target="#myModalNorm"-->

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
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_JS_PATH;?>/bootstrap.min.js"></script>    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_JS_PATH;?>/custom.min.js"></script>




<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                  onclick="closeModal();">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="title"></h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body"> 
                <form role="form">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                      <input type="text" class="form-control" id="date" value=""/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Time</label>
                      <input type="text" class="form-control" id="time" value=""/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Entry Criteria</label>
                      <input type="text" class="form-control" id="entry_criteria" value=""/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Winnings</label>
                      <input type="text" class="form-control" id="winnings" value=""/>
                  </div>
                  <input type="hidden" class="form-control" id="tournament_id" value=""/>
                </form>    
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateTournamentDetails();">Update</button>
                <button type="button" class="btn btn-default" onclick="closeModal();">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Modal html end -->
<script type="text/javascript">
  function showModalWithData(id)
  {
    $.get("/admin/dashboard/getOnlineTournamentDetails?id="+id, function(data, status){

        if(data==0)
          alert("No Tournament Found.");
        else
        {
          var resp = JSON.parse(data);
          $('#tournament_id').val(id);
          $('#title').text(resp.tourney_name);
          $('#date').val(resp.date);
          $('#time').val(resp.time);
          $('#entry_criteria').val(resp.entry_criteria);
          $('#winnings').val(resp.winnings);
          $('#myModalNorm').modal('show');
        }

    });
  }

  function updateTournamentDetails()
  {
      var id = $('#tournament_id').val();
      var date =  $('#date').val();
      var time = $('#time').val();
      var entry_criteria = $('#entry_criteria').val();
      var winnings = $('#winnings').val();
      $.post("/admin/dashboard/updateOnlineTournamentDetails",
      { 
          date :date,
          time :time,
          entry_criteria: entry_criteria,
          winnings :winnings,
          id:id
      },
      function(data, status){
        if(data)
          alert("Tournament details Updated Successfully.");
        else
          alert("Something Went Wrong. Please Try After Sometime.");

      });
  }

  function deleteTournament(id)
  {
    var resp = confirm('Are You Sure You Want To Delete This Tournament?');
    if(resp)
    {
      $.get("/admin/dashboard/deleteOnlineTournamentDetails?id="+id, function(data, status){
        if(data)
        {
          alert("Tournament Deleted Successfully.");
          location.reload();
        }
        else
          alert("Something Went Wrong. Please Try After Sometime.");
    });
    }
  }

  function closeModal()
  {
    $('#myModalNorm').modal('hide');
    location.reload();
  }
</script>
</body>
</html>
