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
              <a>Qualifier List</a>
            </li>
            <li>
              <a href="/admin/qualifier/addQualifier">Add Qualifier</a>
            </li>
          </ul>                 
          <div class="tab-content">
            <div class="tab-pane active" id="panel-565085">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(!empty($qualifier_list))
                  {
                    foreach($qualifier_list as $row) 
                    {
                    ?>
                    <tr>
                      <td><?php echo $row['user_name']; ?></td>
                      <td><?php echo $row['category_name']; ?></td>
                      <td class="setImg"><img style="width:100px;height:50px;" src="<?php echo QUALIFIER_IMAGES_SHOW_PATH.$row['qualifier_image']; ?>"></td>
                      <td class="btnsec">
                        <?php
                          if($row['status'] == 1)
                          {
                            ?>
                            <a class="btn btn-warning" onclick=" return confirm('Are You Sure?')" href="/admin/qualifier/updateQualifierStatus/<?php echo $row['qualifier_id']; ?>/0">Deactivate</a>
                          <?php
                          }
                          else
                          { ?>
                            <a class="btn btn-success" onclick=" return confirm('Are You Sure?')" href="/admin/qualifier/updateQualifierStatus/<?php echo $row['qualifier_id']; ?>/1">Activate</a>
                          <?php
                          }
                        ?>
                        <a class="btn btn-danger" onclick=" return confirm('Are You Sure?')" href="/admin/qualifier/updateQualifierStatus/<?php echo $row['qualifier_id']; ?>/2">Delete</a>

                        <a class="btn btn-info" href="/admin/qualifier/editQualifier/<?php echo $row['qualifier_id']; ?>">Edit</a>
                      </td>
                    </tr>
                    <?php
                      }
                    }
                    else
                    {
                      ?>
                      <tr><td colspan="4">No Record Found </td></tr>
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
<div class="pagination">
<?php
echo $this->pagination->create_links();
?>
</div>