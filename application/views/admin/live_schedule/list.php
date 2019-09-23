<!-- top tiles -->
<div class="row">
	<h2>Manage Live Schedule</h2>
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
					<a>Live Schedule</a>
				</li>
				<li>
					<a href="/admin/schedule/liveUpload">Upload Live Schedule</a>
				</li>
			</ul>
			<div class="tab-pane active">
				<div class="tab-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sr.</th>
								<th>Tourney Name</th>
								<th>City</th>
								<th>Venue</th>
								<th>Date Time</th>
								<th>Seats Available</th>
								<?php if ($results) { ?>
								<th class="dropdown">
									<button class="btn btn-sacondary dropdown-toggle" type="button" data-toggle="dropdown">Action
  										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="/admin/schedule/export/live">Export</a></li>
										<li><a href="/admin/schedule/delete/live" onclick="return confirm('Are you sure? You want to delete all completed tourney.');">Delete Completed</a></li>
									</ul>
								</th>
								<?php }else{?>
								<th>Action</th>
								<?php }?>
							</tr>
						</thead>
						<?php $i=1;if ($results) { ?>
						<?php foreach ($results as $data) { ?>
						<tbody>
							<tr>
								<td>
									<?php echo $i++;?>
								</td>
								<td>
									<?php echo ucwords($data->tourney_name);?>
								</td>
								<td>
									<?php echo ucwords($data->city);?>
								</td>
								<td>
									<?php echo ucwords($data->venue);?>
								</td>
								<td>
									<?php echo $data->date.' '.$data->time;?>
								</td>
								<td>
									<?php echo ucwords($data->entry);?>
								</td>
								<td class="btnsec">
									<?php if($data->status == 0){?>
									<a href="/admin/schedule/updateLiveStatus/done/<?php echo $data->id;?>" onclick="return confirm('Are you sure? You want to mark <?php echo $data->tourney_name.' '.$data->date.' '.$data->time;?> tourney as completed.');"
									    class="btn-success">End Tourney</a>
									<?php }if($data->status == 1){?>
									<a>Completed</a>
									<?php }?>
									<a href="/admin/schedule/deleteLive/<?php echo $data->id;?>" onclick="return confirm('Are you sure? You want to delete <?php echo $data->tourney_name.' '.$data->date.' '.$data->time;?>.');"
									    class="btn-danger">Delete</a>
									<a href="/admin/schedule/editLive/<?php echo $data->id;?>" onclick="return confirm('Are you sure? You want to edit <?php echo $data->tourney_name.' '.$data->date.' '.$data->time;?>.');"
									    class="btn-info">Edit</a>
								</td>
							</tr>
						</tbody>
						<?php }}else{?>
						<tbody>
							<tr>
								<td colspan="7">Live Tourney List Not Available</td>
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