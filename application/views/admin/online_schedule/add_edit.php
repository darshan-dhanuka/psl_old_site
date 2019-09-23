<!-- top tiles -->
<div class="row">
	<h2>Manage Online Schedule</h2>
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
				<?php if($form == 'edit'){?>
				<li>
					<a href="/admin/schedule/online" onclick="return confirm('Your edited item will be discarded.');">Online Schedule</a>
				</li>
				<li>
					<a href="/admin/schedule/onlineUpload" onclick="return confirm('Your edited item will be discarded.');">Upload Online Schedule</a>
				</li>
				<li class="active">
					<a>Edit Online Schedule</a>
				</li>
				<?php }else{?>
				<li>
					<a href="/admin/schedule/online">Online Schedule</a>
				</li>
				<li class="active">
					<a>Upload Online Schedule</a>
				</li>
				<?php }?>
			</ul>
			<?php $post_data = array();$post_data = ($form == 'edit')?$tourney:$this->session->flashdata('post_data');?>
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">
								<?php if($form == 'edit'){?>
								<input type="hidden" name="id" value="<?php echo (isset($post_data['id'])?$post_data['id']:'');?>">
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Tourney Name:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="tourney_name" placeholder="Tourney Name" maxlength="100" value="<?php echo isset($post_data['tourney_name'])?$post_data['tourney_name']:'';?>" required>
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Date:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="date" placeholder="Date" maxlength="100" value="<?php echo isset($post_data['date'])?$post_data['date']:'';?>" required>
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Time:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="time" placeholder="Time" maxlength="100" value="<?php echo isset($post_data['time'])?$post_data['time']:'';?>" required>
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Entry Criteria:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="entry_criteria" placeholder="Entry Criteria" maxlength="100" value="<?php echo isset($post_data['entry_criteria'])?$post_data['entry_criteria']:'';?>" required>
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Winnings:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="winnings" placeholder="Winnings" maxlength="100" value="<?php echo isset($post_data['winnings'])?$post_data['winnings']:'';?>" required>
									</div>
								</div>
								<?php }else{?>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Upload Online Schedule:</label>
									<div class="col-sm-5">
										<input type="file"  class="form-control" name="online_schedule" required>
									</div>
								</div>
								<?php }?>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<button type="submit" class="btn btn-primary" name="add"> <?php echo ($form == 'edit')?'Update Online Schedule':'Upload Schedule'?></button>
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