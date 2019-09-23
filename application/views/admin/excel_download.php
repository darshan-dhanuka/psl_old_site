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
                <!-- <th>CheckProof</th> -->
                <th>Status</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <?php foreach ($user_details as $data) { ?>
            <tbody>
              <tr>
                <td><?php echo $data['user_id'];?></td>
                <td><?php echo $data['user_name'];?></td>
                <td><?php echo $data['first_name'].' '.$data['last_name'];?></td>
                <td><?php echo $data['dob'];?></td>
                <td><?php echo $data['gender'];?></td>
                <td><?php echo $data['mobile'];?></td>
                <td><?php echo $data['email'];?></td>
                <td><?php echo $data['address1'];?></td>
                <td><?php echo $data['state'];?></td>
                <td><?php echo $data['city'];?></td>
                <td><?php echo $data['doc_name'];?></td>                
<!--                 <td><?php if($data['doc_path'] !=''){ ?><a href="/uploads/<?php echo $data['doc_path']; ?>" download>Download</a><?php }else{ ?>&nbsp;<?php } ?></td> -->
                <td><?php echo $data['doc_status'];?></td>
                <td><?php if($data['doc_status']=='pending'){ ?>
            <button class="btn btn-primary btn_<?php echo $data['user_id'];?>" onclick="changeStatus('<?php echo $data['user_id']; ?>','verified');" >Approve</button>
            <!-- <button class="btn btn-primary btn_<?php echo $data['user_id'];?>"  onclick="changeStatus('<?php echo $data['user_id']; ?>','rejected');" >Reject</button> -->
            <?php } ?></td>  
              </tr>
            </tbody>
            <?php }?>
          </table>     