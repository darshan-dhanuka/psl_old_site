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
          <a href="/admin/banner">Banner List</a>
        </li>
        <li>
          <a href="/admin/banner/addHomepageBanner">Add Banner</a>
        </li>
        <li class="active">
          <a>Edit Banner</a>
        </li>
      </ul>                 
      <div class="tab-content">
        <div class="tab-pane active" id="panel-565086">
          <div class="col-xs-12">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $banner_data['id']; ?>" name="banner_id">

              <div class="form-group">
                <label class="control-label col-sm-2" for="">Banner Website:</label>
                <div class="col-sm-5">
                <input type="file" name="banner_website">
                <div id="banner_website" class="text-danger"><?php echo form_error("banner_website"); ?></div>
                </div>
              </div>



              <div class="form-group">
                <label class="control-label col-sm-2" for="">Banner Mobile:</label>
                <div class="col-sm-5">
                <input type="file" name="banner_mobile">
                <div id="banner_mobile" class="text-danger"><?php echo form_error("banner_mobile"); ?></div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="">Banner Text:<span class="text-danger">*</span></label>
                <div class="col-sm-5"><textarea required name="banner_text" maxlength="500"><?php echo $banner_data['banner_text']; ?></textarea>
                  <div id="banner_text" class="text-danger"><?php echo form_error("banner_text"); ?></div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="">Button Text:<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                  <input type="text"  required name="button_text"  maxlength="25" value="<?php echo $banner_data['button_text']; ?>">
                  <div id="button_text" class="text-danger"><?php echo form_error("button_text"); ?></div>
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-sm-2" for="">Button Url:<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                 <div class="input-group">
                	<span class="input-group-addon" id="basic-addon3" ><?php echo base_url();?></span>
                  <input type="text"  required name="button_url" pattern="[A-Za-z0-9-_/]{3,}" title="Only A-Z a-z 0-9 '-' '_'  '/' are allowed. Minimum 3 character" maxlength="255" value="<?php echo $banner_data['button_url']; ?>">
                  </div>
                  <div id="button_url" class="text-danger"><?php echo form_error("button_url"); ?></div>
                </div>
              </div>

              
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Priority:<span class="text-danger">*</span></label>
                <div class="col-sm-5">
                    <input type="number" name="priority" required value="<?php echo $banner_data['priority']; ?>">
                    <div id="priority" class="text-danger"><?php echo form_error("priority"); ?></div>
                </div>
              </div>


              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-5">
                <input type="hidden" name="status" value="<?php echo $banner_data['status'];?>" >
                  <button type="submit" class="btn btn-info" name="submit" class="btn btn-default">Submit</button>
                  <a href="/admin/banner" class="btn btn-warning">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
      