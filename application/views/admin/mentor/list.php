<!-- top tiles -->
<div class="row">
	<h2>Manage Player</h2>
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
					<a>Player List</a>
				</li>
				<li>
					<a href="/admin/mentor/addNew">Add Player</a>
				</li>
			</ul>
			<div class="tab-pane active">
				<div class="tab-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Mentor</th>
								<th>Name</th>
								<th>Team</th>
								<th>Type</th>
								<th>Last Modified</th>
								<th>Update By</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php if (!empty($results)) { ?>
						<?php foreach ($results as $data) { ?>
						<tbody>
							<tr>
								<td class="setImg"><?php if($data->mentor_pic <> ''){?><img height=50 width=50 src="<?php echo $data->mentor_pic;?>" alt="<?php echo $data->mentor_name;?>"><?php }else{ echo '<img height=50 width=50 src="/images/mentor/default.jpg" alt="'.$data->mentor_name.'">';}?></td>
								<td>
									<?php echo ucwords($data->mentor_name);?>
								</td>
								<td>
									<?php echo ucwords($data->team_name);?>
								</td>
								<td>
									<?php echo ucwords($data->mentor_type);?>
								</td>
								<td>
									<?php echo date('d-m-Y H:i',$data->linux_modified_on);?>
								</td>
								<td>
									<?php echo ucwords($data->author_name);?>
								</td>
								<td class="btnsec">
									<?php if($data->mentor_status == 0){?>
									<a href="/admin/mentor/updateStatus/active/<?php echo $data->mentor_id;?>" onclick="return confirm('Are you sure? You want to active mentor <?php echo $data->mentor_name;?>.');"
									    class="btn-success">Activate</a>
									<?php }if($data->mentor_status == 1){?>
									<a href="/admin/mentor/updateStatus/inactive/<?php echo $data->mentor_id;?>" onclick="return confirm('Are you sure? You want to inactive mentor <?php echo $data->mentor_name;?>.');"
									    class="btn-success">Inactivate</a>
									<?php }?>
									<a href="/admin/mentor/delete/<?php echo $data->mentor_id;?>" onclick="return confirm('Are you sure? You want to delete mentor <?php echo $data->mentor_name;?>.');"
									    class="btn-danger">Delete</a>
									<a href="/admin/mentor/edit/<?php echo $data->mentor_id;?>" onclick="return confirm('Are you sure? You want to edit mentor <?php echo $data->mentor_name;?>.');"
									    class="btn-info">Edit</a>
								</td>
							</tr>
						</tbody>
						<?php }}else{?>
						<tbody>
							<tr>
								<td colspan="6">Mentor List Not Available</td>
							</tr>
						</tbody>
						<?php }?>
					</table>
					
					<?php if (isset($links)) { ?>
					<?php echo $links ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!--Page Body End-->
</div>