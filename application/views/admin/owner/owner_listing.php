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
          <a>Owner List</a>
        </li>
        <li>
          <a href="/admin/owner/addTeamOwner">Add Owner</a>
        </li>
      </ul>                 
      <div class="tab-content">
        <div class="tab-pane active" id="panel-565085">
          <div class="col-xs-12">
            <table class="table table-bordered">
              <thead>

                <tr>
                  <th>Owner Image</th>
                  <th>Owner Name</th>
                  <th>Owner Company</th>
                  <th>Team</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(!empty($owner_list))
                  {
                    foreach($owner_list as $row) 
                    {
                    ?>
                    <tr>
                      <td class="setImg"><img style="max-width:100px;max-height:100px;" src="<?php echo OWNER_IMAGE_PATH.$row['owner_image']; ?>"></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['company_name']; ?></td>
                      <td><?php echo isset($team_master[$row['team_id']])?$team_master[$row['team_id']]:'NA'; ?></td>
                      <td class="btnsec">
                        <?php
                          if($row['status'] == 1)
                          {
                            ?>
                            <a class="btn btn-warning" onclick=" return confirm('Are You Sure?')" href="/admin/owner/updateOwnerStatus?owner_id=<?php echo $row['id']; ?>&status=0">Deactivate</a>
                          <?php
                          }
                          else
                          { ?>
                            <a class="btn btn-success" onclick=" return confirm('Are You Sure?')" href="/admin/owner/updateOwnerStatus?owner_id=<?php echo $row['id']; ?>&status=1">Activate</a>
                          <?php
                          }
                        ?>
                        <a class="btn btn-danger" onclick=" return confirm('Are You Sure?')" href="/admin/owner/deleteTeamOwner?owner_id=<?php echo $row['id']; ?>">Delete</a>

                        <a class="btn btn-info" href="/admin/owner/editTeamOwner/<?php echo $row['id']; ?>">Edit</a>
                      </td>
                    </tr>
                    <?php
                      }
                    }
                    else
                    {
                      ?>
                      <tr><td colspan="5">No Record Found </td></tr>
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
</div>
<div class="pagination">
<?php
echo $this->pagination->create_links();
?>
</div>


