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
        <li class="active">
          <a>Add Banner</a>
        </li>
      </ul>                 
      <div class="tab-content">
        <div class="tab-pane active" id="panel-565086">
          <div class="col-xs-12">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Banner Website:</label>
                <div class="col-sm-5">
                <input type="file"  required name="banner_website">
                <div id="banner_website" class="text-danger"><?php echo form_error("banner_website"); ?></div>
                </div>
              </div>

              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Banner Mobile:</label>
                <div class="col-sm-5">
                <input type="file"  required name="banner_mobile">
                <div id="banner_mobile" class="text-danger"><?php echo form_error("banner_mobile"); ?></div>
                </div>
              </div>

              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Banner Text:</label>
                <div class="col-sm-5"><textarea required name="banner_text" maxlength="500"></textarea>
                  <div id="banner_text" class="text-danger"><?php echo form_error("banner_text"); ?></div>
                </div>
              </div>

              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Button Text:</label>
                <div class="col-sm-5">
                  <input type="text"   placeholder="Button Text" required name="button_text" maxlength="25">
                  <div id="button_text" class="text-danger"><?php echo form_error("button_text"); ?></div>
                </div>
              </div>


              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Button Url:</label>
                <div class="col-sm-5">
                <div class="input-group">
                	<span class="input-group-addon" id="basic-addon3" ><?php echo base_url();?></span>
                  <input type="text"  placeholder="Page URL" pattern="[A-Za-z0-9-_/]{3,}" title="Only A-Z a-z 0-9 '-' '_'  '/' are allowed. Minimum 3 character" required name="button_url" maxlength="255">
                  <div id="button_url" class="text-danger"><?php echo form_error("button_url"); ?></div>
                  </div>
                </div>
              </div>

              
              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Priority:</label>
                <div class="col-sm-5">
                  <input type="number" name="priority"  placeholder="Priority" required>
                  <div id="priority" class="text-danger"><?php echo form_error("priority"); ?></div>
                </div>
              </div>


              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-5">
                  <button type="submit" name="submit" class="btn btn-info">Submit</button>
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

