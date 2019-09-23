<!-- top tiles -->
<div class="row">
	<h2>Manage Team</h2>
</div>
<div class="row">
	<div style="min-height:50px">
		<?php echo $this->session->flashdata('msg');?>
	</div>
</div>
<div class="row">
	<!--Page Body Start-->
	<div class="col-md-12">
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active">
					<a>Team List</a>
				</li>
				<li>
					<a href="/admin/team/addTeam">Add Team</a>
				</li>
			</ul>
			<div class="tab-pane active">
				<div class="tab-content">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Logo</th>
						<th>Website Banner</th>
						<th>Mobile Banner</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
      <?php foreach($list as $team){?>
      <tr>
						<td><?php echo $team['team_name'] ?></td>
						<td class="setImg"><img
							src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $team['team_logo']; ?>"
							alt="" height="70" width="80"></td>
						<td class="setImg"><img
							src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $team['team_website_banner']; ?>"
							alt="" height="70" width="70"></td>
						<td class="setImg"><img
							src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $team['team_mobile_banner']; ?>"
							alt="" height="70" width="70"></td>
						<td class="btnsec"><a
							href="team/updateStatus/<?php echo $team['id'].'/'.$team['status'] ?>"
							class="btn btn-success" onclick=" return confirm('Are You Sure?')"><?php echo ($team['status']==0)?'Activate':'Deactivate'?></a>
							<a href="team/delete/<?php echo $team['id'];?>"
							class="btn btn-danger" onclick=" return confirm('Are You Sure?')">Delete</a> <a
							href="team/editTeam?team_id=<?php echo $team['id'];?>"
							class="btn btn-info">Edit</a></td>
					</tr>
      <?php } ?>
    </tbody>
			</table>
</div>
			</div>
		</div>
	</div>
	<!--Page Body End-->
</div>