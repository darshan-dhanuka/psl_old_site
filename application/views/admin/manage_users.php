<!-- top tiles -->
<div class="data">
  <h2>Manage Users</h2>
</div>
<div class="data">
  <div style="min-height: 50px">
    <?php echo $this->session->flashdata('msg');?>
  </div>
</div>
<div class="data">
  <!--Page Body Start-->
  <div class="col-md-12">
    <div class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active"><a>Search User</a></li>
      </ul>
      <?php $post_data = array();$post_data = $this->session->flashdata('post_data');?>
      <div class="tab-pane active">
        <div class="tab-content">
          <div class="data">
            <div class="col-md-12">
              <form class="form-horizontal fv-form fv-form-bootstrap" method="post">

                <div class="form-group">
                  <label class="control-label col-sm-2" for="">User name:</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" placeholder="User name" maxlength="100" value="<?php echo isset($_POST['username'])?$_POST['username']:'';?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">User State:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="listBox" name="state">
                    <option value="">Select</option>
                    <?php foreach($states_list as $state){?>
                      <option value="<?php echo $state ;?>" <?php echo ($this->input->post('state')==$state)?'selected':''; ?>><?php echo $state ;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">User Status:</label>
                  <div class="col-sm-5">
                    <select class="form-control" name="status">
                    <option value="">-- Select Status --</option>
                      <option value="verified" <?php echo ($this->input->post('status')=='verified')?'selected':''; ?>>Verified</option>
                      <option value="rejected" <?php echo ($this->input->post('status')=='rejected')?'selected':''; ?>>Rejected</option>
                      <option value="pending" <?php echo ($this->input->post('status')=='pending')?'selected':'';?>>Pending</option>
                      <option value="not submitted" <?php echo ($this->input->post('status')=='not submitted')?'selected':''; ?>>Not Submitted</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-5">
                    <button type="submit" class="btn btn-primary" name="add"> Search User</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Page Body End-->
</div>
<?php if ($user_details) { ?>
<!--Display Search List-->
<div class="col-md-12">
  <input type="button" onclick="downloadExcel()" value="Export to Excel">
      <div style="overflow-x:scroll;max-height: 500px; overflow-y: scroll;">
        <table class="table table-bordered" id="exportTable">
          <thead>
            <tr>
              <th>User ID</th>
              <th>User name</th>
              <th>Name</th>
              <th>DOB</th>
              <th>Gender</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Address</th>
              <th>State</th>
              <th>City</th>
              <th>ProofSubmitted</th>
              <th>CheckProof</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($user_details as $data) { ?>
            <tr>
              <td>
                <?php echo $data['user_id'];?>
              </td>
              <td>
                <?php echo $data['user_name'];?>
              </td>
              <td>
                <?php echo $data['first_name'].' '.$data['last_name'];?>
              </td>
              <td>
                <?php echo $data['dob'];?>
              </td>
              <td>
                <?php echo $data['gender'];?>
              </td>
              <td>
                <?php echo $data['mobile'];?>
              </td>
              <td>
                <?php echo $data['email'];?>
              </td>
              <td>
                <?php echo $data['address1'];?>
              </td>
              <td>
                <?php echo $data['state'];?>
              </td>
              <td>
                <?php echo $data['city'];?>
              </td>
              <td>
                <?php echo $data['doc_name'];?>
              </td>
              <td>
                <?php if($data['doc_path'] !=''){ ?><a href="/uploads/<?php echo $data['doc_path']; ?>" download>Download</a>
                <?php }else{ ?>&nbsp;
                <?php } ?>
              </td>
              <td>
                <?php echo $data['doc_status'];?>
              </td>
              <td>
                <?php if($data['doc_status']=='pending'){ ?>
                <button class="btn btn-primary btn_<?php echo $data['user_id'];?>" onclick="changeStatus('<?php echo $data['user_id']; ?>','verified');">Approve</button>
                <button class="btn btn-primary btn_<?php echo $data['user_id'];?>" onclick="changeStatus('<?php echo $data['user_id']; ?>','rejected');">Reject</button>
                <?php } ?>
              </td>
            </tr>
          <?php }?>
          </tbody>
        </table>
      </div>    
</div>
<?php } ?>