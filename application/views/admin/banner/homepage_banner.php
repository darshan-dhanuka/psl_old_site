<div class="row">
  <div style="min-height:50px">
    <?php echo $this->session->flashdata('msg');?>
  </div>
</div>
    <div class="row">
      <div class="col-xs-12">
        <div class="tabbable" id="tabs-491480">
          <ul class="nav nav-tabs">
            <li class="active">
              <a>Banner List</a>
            </li>
            <li>
              <a href="/admin/banner/addHomepageBanner">Add Banner</a>
            </li>
          </ul>                 
          <div class="tab-content">
            <div class="tab-pane active" id="panel-565085">
      <!--      <div class='notification-div' style="margin-top:20px;margin-bottom:20px;"></div> -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Banner Website</th>
                  <th>Banner Mobile</th>
                  <th>Banner Text</th>
                  <th>Button Text</th>
                  <th>Button URL</th>
                  <th>Priority</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(!empty($banner_list))
                  {
                    foreach($banner_list as $row) 
                    {
                    ?>
                    <tr>
                      <td class="setImg"><img style="width:100px;height:50px;" src="<?php echo BANNER_DATA_PATH.$row['banner_website']; ?>"></td>
                      <td class="setImg"><img style="width:100px;height:50px;" src="<?php echo BANNER_DATA_PATH.$row['banner_mobile']; ?>"></td>
                      <td><?php echo $row['banner_text']; ?></td>
                      <td><?php echo $row['button_text']; ?></td>
                      <td><?php echo $row['button_url']; ?></td>
                      <td><?php echo $row['priority']; ?></td>
                      <td class="btnsec">
                        <?php
                          if($row['status'] == 1)
                          {
                            ?>
                            <a class="btn btn-warning" onclick=" return confirm('Are You Sure?')" href="/admin/banner/updateBannerStatus?banner_id=<?php echo $row['id']; ?>&status=0">Deactivate</a>
                          <?php
                          }
                          else
                          { ?>
                            <a class="btn btn-success" onclick=" return confirm('Are You Sure?')" href="/admin/banner/updateBannerStatus?banner_id=<?php echo $row['id']; ?>&status=1">Activate</a>
                          <?php
                          }
                        ?>
                        <a class="btn btn-danger" onclick=" return confirm('Are You Sure?')" href="/admin/banner/deleteHomepageBanner?banner_id=<?php echo $row['id']; ?>">Delete</a>

                        <a class="btn btn-info" href="/admin/banner/editHomepageBanner/<?php echo $row['id']; ?>">Edit</a>
                      </td>
                    </tr>
                    <?php
                      }
                    }
                    else
                    {
                      ?>
                      <tr><td colspan="7">No Record Found </td></tr>
                    <?php
                    }
                    ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


