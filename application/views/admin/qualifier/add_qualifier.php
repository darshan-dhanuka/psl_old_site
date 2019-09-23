<div class="row">
  <h2>Manage Qualifier</h2>
</div>
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
          <a href="/admin/qualifier">Qualifier List</a>
        </li>
        <li href="/admin/qualifier/addQualifier" class="<?php echo ($form != 'edit')?'active':''?>">
          <a>Add Qualifier</a>
        </li>
        <?php if($form == 'edit'){ ?>
        <li class="active">
          <a>Edit Mentor</a>
        </li>
        <?php } ?>
      </ul>                 
      <div class="tab-content">
        <div class="tab-pane active" id="panel-565086">
          <div class="col-xs-12">
            <form class="form-horizontal" method="post" action="<?php echo ($form == 'edit')?'/admin/qualifier/editQualifier/'.$qualifier_details[0]['id']:'' ?>" enctype="multipart/form-data">
                <div class="form-group required">
                <label class="control-label col-sm-2" for="">Qualifier Category:</label>
                <div class="col-sm-5">
                  <select name="category_id" required>
                    <option value="">Select</option>
                    <?php foreach($category_list as $list){?>
                      <option value="<?php echo $list['id']; ?>" <?php echo (isset($qualifier_details[0]['category_id']) && $list['id']==$qualifier_details[0]['category_id'])?'selected':'' ?>><?php echo $list['category_name']; ?></option>
                    <?php } ?>
                  </select>
                  <div class="text-danger"><?php echo form_error("qualifier_category"); ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Username:</label>
                <div class="col-sm-5">
                <input type="text"  required name="user_name" value="<?php echo (isset($qualifier_details[0]['user_name']))?$qualifier_details[0]['user_name']:'' ?>" <?php echo(isset($qualifier_details[0]['user_name']))?'readonly':''?> >
                <?php if($form != 'edit'){ ?>
                  <input type="hidden" name="user_id">
                  <input type="button" id="get_user" value="Get User">
                <?php } ?>
                <div class="text-danger"><?php echo form_error("user_id"); ?></div>
                <div class="text-danger"><?php echo form_error("user_name"); ?></div>
                </div>
              </div>
              <div class="form-group required">
                <label class="control-label col-sm-2" for="">Team:</label>
                <div class="col-sm-5">
                  <select name="team_id" required>
                    <option value="">Select</option>
                    <?php foreach($team_list as $list){?>
                      <option value="<?php echo $list['id']; ?>" <?php echo (isset($qualifier_details[0]['team_id']) && $list['id']==$qualifier_details[0]['team_id'])?'selected':'' ?>><?php echo $list['team_name']; ?></option>
                    <?php } ?>
                  </select>
                  <div class="text-danger"><?php echo form_error("team_id"); ?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="">Qualifier Image:</label>
                <div class="col-sm-5">
                <input type="file" name="qualifier_image">
                <div class="text-danger"><?php echo form_error("qualifier_image"); ?></div>
                </div>
                <?php if($form == 'edit'){ ?>
                 <img src="<?php echo QUALIFIER_IMAGES_SHOW_PATH.$qualifier_details[0]['qualifier_image'] ?>" height="120" width="240">
                 <input type="hidden" name="old_image_name" value="<?php echo $qualifier_details[0]['qualifier_image'] ?>">
                 <?php } ?>
              </div>
              <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-5">
                  <button type="submit" name="submit" class="btn btn-info">Submit</button>
                  <a href="/admin/qualifier" class="btn btn-warning">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

