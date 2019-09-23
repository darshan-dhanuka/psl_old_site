<div class="row">
  <div style="min-height:50px">
    <?php echo $this->session->flashdata('msg');?>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="tabbable" id="tabs-491480">
      <ul class="nav nav-tabs">
        <li>
          <a href="/admin/owner">Owner List</a>
        </li>
        <li class="active">
          <a>Add Team Owner</a>
        </li>
      </ul>                 
      <div class="tab-content">
        <div class="tab-pane active" id="panel-565086">
          <div class="col-xs-12">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Owner Name:<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                <input type="text"  required name="name" maxlength="50">
                  <div id="name" class="text-danger"><?php echo form_error("name"); ?></div>
                </div>
              </div>

               <div class="form-group required">
                <label class="control-label col-sm-2" for="">Owner Team:<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  <select name="team_id" required>
                    <?php
                    foreach($team_master as $team_id=>$team_name)
                    {
                      ?>
                      <option value="<?php echo $team_id; ?>"><?php echo $team_name; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="">Owner Company:</label>
                <div class="col-sm-5">
                <input type="text" name="company_name" maxlength="50">
                  <div id="company_name" class="text-danger"><?php echo form_error("company_name"); ?></div>
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-sm-2" for="">Owner Image:</label>
                <div class="col-sm-5">
                <input type="file" name="owner_image">
                <div id="owner_image" class="text-danger"><?php echo form_error("owner_image"); ?></div>
                </div>
              </div>

              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-5">
                  <button type="submit" name="submit" class="btn btn-info">Submit</button>
                  <a href="/admin/owner" class="btn btn-warning">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
