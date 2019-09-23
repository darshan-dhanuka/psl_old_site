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
				<?php if($form == 'edit'){?>
				<li>
					<a href="/admin/mentor" onclick="return confirm('Your edited item will be discarded.');">Player List</a>
				</li>
				<li>
					<a href="/admin/mentor/addNew" onclick="return confirm('Your edited item will be discarded.');">Add Player</a>
				</li>
				<li class="active">
					<a>Edit Player</a>
				</li>
				<?php }else{?>
				<li>
					<a href="/admin/mentor">Player List</a>
				</li>
				<li class="active">
					<a>Add Player</a>
				</li>
				<?php }?>
			</ul>
			<?php $post_data = array();$post_data = ($form == 'edit')?$mentor:$this->session->flashdata('post_data');?>
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">
								<input type="hidden" name="mentor_id" value="<?php echo (isset($post_data['mentor_id'])?$post_data['mentor_id']:'');?>">
								
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Player Type:</label>
									<div class="col-sm-5">
										<select class="form-control" name="mentor_type" required>
										<option>Select Type</option>										
										<option value ="Mentor" <?php echo ($post_data['mentor_type'] == 'Mentor')?'selected':'';?>>Mentor</option>
										<option value ="Pro" <?php echo ($post_data['mentor_type'] == 'Pro')?'selected':'';?>>Pro</option>
										<option value ="Wildcard" <?php echo ($post_data['mentor_type'] == 'Wildcard')?'selected':'';?>>Wildcard</option>
										</select>
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Player Name:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="mentor_name" placeholder="Mentor Name" value="<?php echo isset($post_data['mentor_name'])?$post_data['mentor_name']:'';?>" required maxlength="50">
									</div>
								</div>
								<div class="form-group <?php echo ($form=='edit' )? '': 'required'?>">
									<label class="control-label col-sm-2" for="">Player Picture:</label>
									<?php if(isset($mentor)){?>
										 <img src="<?php echo MENTOR_IMAGES_PATH?>/<?php echo $mentor['mentor_pic']; ?>" alt="" style="max-height:150px;max-width:150px;">
									<?php }?>
									<div class="col-sm-5">
										<input type="file"  class="form-control" name="mentor_picture" placeholder="Mentor Picture" <?php echo ($form == 'edit')?'':'required'?>>
									</div>
								</div>
								<div class="form-group <?php echo ($form=='edit' )? '': 'required'?>">
									<label class="control-label col-sm-2" for="">Player Slider Picture:</label>
									<?php if(isset($mentor)){?>
										 <img src="<?php echo MENTOR_IMAGES_PATH?>/<?php echo $mentor['mentor_slider_pic']; ?>" alt="" style="max-height:150px;max-width:150px;">
									<?php }?>
									<div class="col-sm-5">
										<input type="file" class="form-control" name="mentor_slider_picture" placeholder="Mentor Slider Picture"  <?php echo ($form == 'edit')?'':'required'?>>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Mentor HomePage Popup:</label>
									<div class="col-sm-5">
										<input type="radio" <?php if(isset($mentor)){ if( $mentor['mentor_popup']==1){ echo "checked ";} }?> checked  name="mentor_popup" value="1"  id="">Enable <input type="radio" <?php if(isset($mentor)){ if( $mentor['mentor_popup']==0){ echo "checked ";} }?>  value="0"name="mentor_popup" id="">Disable
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Player Age:</label>
									<div class="col-sm-5">
										<input type="number" class="form-control" name="mentor_age" min = "0" class="form-control" id="" value="<?php echo isset($post_data['mentor_age'])?$post_data['mentor_age']:'';?>" placeholder="Mentor Age">
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="sel1">Player Team:</label>
									<div class="col-sm-5">
									<select class="form-control" name="mentor_team_id" required>
										<option>Select Mentor Team</option>
										<?php if($teams){ foreach($teams as $team){?>
										<option value ="<?php echo $team['id'];?>" <?php echo ($post_data['mentor_team_id'] == $team['id'])?'selected':'';?>><?php echo $team['team_name'];?></option>
										<?php }}?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Player GPI:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="mentor_gpi" placeholder="Mentor GPI" maxlength="50" value="<?php echo isset($post_data['mentor_gpi'])?$post_data['mentor_gpi']:'';?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Player ITM:</label>
									<div class="col-sm-5">
										<input type="number" class="form-control" name="mentor_itm" min="0" placeholder="Mentor ITM" value="<?php echo isset($post_data['mentor_itm'])?$post_data['mentor_itm']:'';?>">
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="comment">Player Description:</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="5" id="comment" name="mentor_description" required maxlength="500"><?php echo isset($post_data['mentor_description'])?$post_data['mentor_description']:'';?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Player Condition Text:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="mentor_condition_text" placeholder="Mentor Condition Text" maxlength="100" value="<?php echo isset($post_data['mentor_condition_text'])?$post_data['mentor_condition_text']:'';?>">
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Player status:</label>
									<div class="col-sm-5">
										<div class="radio col-sm-2">
											<label><input type="radio" name="mentor_status" value="1" <?php echo isset($post_data['mentor_status'])?(($post_data['mentor_status'] == 1)?'checked':''):'checked';?>>Active</label>
										</div>
										<div class="radio col-sm-2">
											<label><input type="radio" name="mentor_status" value="0" <?php echo isset($post_data['mentor_status'])?(($post_data['mentor_status'] == 0)?'checked':''):'';?>>Inactive</label>
										</div>
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<button type="submit" class="btn btn-primary" name="add"> <?php echo ($form == 'edit')?'Update Mentor':'Add Mentor'?></button>
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