<!DOCTYPE html>
<html lang="en">
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
            PSL Dashboard
          </div>
            <?php if($_GET['msg'] == 'success'){echo 'successfully saved data';}?>
            <form method="post" action="" enctype="multipart/form-data">
                <div>Choose file <input type="file" name="userfile">(only CSV and comma seprated)</div><br/>
                <div><input type="submit" name="submit" value="Submit"></div>
            </form>
          <!-- /top tiles -->
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
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_JS_PATH;?>/bootstrap.min.js"></script>    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_JS_PATH;?>/custom.min.js"></script>



  </body>
</html>
