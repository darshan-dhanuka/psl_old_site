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
				<?php if($form == 'edit'){?>
				<li><a href="/admin/team" onclick="return confirm('Your edited item will be discarded.');">Team List</a></li>
				<li><a href="/admin/team/addTeam" onclick="return confirm('Your edited item will be discarded.');">Add Team</a></li>
				<li class="active"><a>Edit Team</a></li>
				<?php }else{?>
				<li><a href="/admin/team">Team List</a></li>
				<li class="active"><a>Add Team</a></li>
				<?php }?>
			</ul>
			<?php if(isset($status)){ if($status){echo '<div style="color:green">'.$msg.'</div>';}else{ echo '<div style="color:red">'.$msg.'</div>';}}?>			
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<?php if(isset($status)){ if($status){echo '<div style="color:green">'.$msg.'</div>';}else{ echo '<div style="color:red">'.$msg.'</div>';}}?>
						<form method="post" class="form-horizontal"  action="" name="addPage" id="addPage" enctype="multipart/form-data">
						  <div class="form-group">
								<label class="control-label col-sm-2" for="">Name(<span class="text-danger">*</span>):</label>

								<div class="col-sm-5">
									<input type="text" class="form-control" id="" placeholder="Team Name" name="team_name" value="<?php if(isset($teamDetails)){echo $teamDetails[0]['team_name'];} ?>" required>
      								<div class="text-danger"><?php echo form_error('team_name'); ?></div>
    							</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Logo Upload(<span class="text-danger">*</span>):</label>
								<?php if(isset($teamDetails)){?>
								 <img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $teamDetails[0]['team_logo']; ?>" alt="" height="70" width="80">
								<?php }?>
								<div class="col-sm-5">
									<input type="file" name="team_logo">
  									<div class="text-danger">	<?php echo form_error('team_logo'); ?></div>
   								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Show on home page :</label>
								<div class="col-sm-5">
									<input type="radio" name="homepageLogo" <?php if(isset($teamDetails)){ if( $teamDetails[0]['homepageLogo']==1){ echo "checked ";} }?> checked value="1">Enable 
								    <input type="radio" name="homepageLogo" <?php if(isset($teamDetails)){ if( $teamDetails[0]['homepageLogo']==0){ echo "checked ";} }?> value="0">Disable  
  									<div class="text-danger">	<?php echo form_error('team_logo'); ?></div>
   								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Website Banner Upload(<span class="text-danger">*</span>):</label>
								<?php if(isset($teamDetails)){?>
								 <img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $teamDetails[0]['team_website_banner']; ?>" alt="" height="70" width="80">
								<?php }?>
								<div class="col-sm-5">
									<input type="file" name="team_website_banner">
							  	<div class="text-danger">	<?php echo form_error('team_website_banner'); ?></div>
							   </div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Mobile Banner Upload(<span class="text-danger">*</span>):</label>
								<?php if(isset($teamDetails)){?>
								 <img src="<?php echo TEAM_IMAGES_PATH?>/<?php echo $teamDetails[0]['team_mobile_banner']; ?>" alt="" height="70" width="80">
								<?php }?>
								<div class="col-sm-5">
									<input type="file" name="team_mobile_banner">
							  	<div class="text-danger">	<?php echo form_error('team_mobile_banner'); ?></div>
							   </div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Region(<span class="text-danger">*</span>):</label>
								<div class="col-sm-5">
									<select name="region">
									<option value="-1">Select</option>
									<?php foreach($zone as $zone){?>
										<option <?php if(isset($teamDetails)){if($teamDetails[0]['region_id']==$zone['id']) echo "selected";}?> value="<?php echo $zone['id'];?>>"><?php echo $zone['region_name']?></option>
									<?php }?>
									
									</select>
   								</div>
							</div>
							<div class="form-group">
								<label  class="control-label col-sm-2" for="">Page Url(<span class="text-danger">*</span>):</label>
								<div class="col-sm-5">
								<div class="input-group">
											<span class="input-group-addon" id="basic-addon3"><?php echo base_url()."teams";?></span>
									<input type="text" class="form-control" pattern="[A-Za-z0-9-_/]{3,}"
												title="Only A-Z a-z 0-9 '-' '_'  '/' are allowed. Minimum 3 character" id="" placeholder="Page Url" name="page_url" value="<?php if(isset($teamDetails)){echo $teamDetails[0]['page_url'];} ?>" required>
      							</div>	
      							<div class="text-danger"><?php echo form_error('page_url'); ?></div>
								</div>
								
							</div>
							<div class="form-group">
								<label  class="control-label col-sm-2" for="">Seo Title:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="" placeholder="Seo Title" name="seo_title" value="<?php if(isset($teamDetails)){echo $teamDetails[0]['seo_title'];} ?>">
      							<div class="text-danger">	<?php echo form_error('seo_title'); ?></div>
								</div>
							</div>
							<div class="form-group">
								<label  class="control-label col-sm-2" for="">Seo Meta tag:</label>
								<div class="col-sm-5">
									<textarea name="seo_keyword" placeholder="Seo keyword"><?php if(isset($teamDetails)){echo $teamDetails[0]['seo_meta'];} ?></textarea>
      								<div class="text-danger"><?php echo form_error('seo_keyword'); ?></div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="">Meet the team button :</label>
								<div class="col-sm-5">
									<input type="radio" name="meet_the_team"  <?php if(isset($teamDetails)){ if( $teamDetails[0]['meet_the_team']==1){ echo "checked ";} }?> checked value="1"> Enable 		<input type="radio" name="meet_the_team"  <?php if(isset($teamDetails)){ if( $teamDetails[0]['meet_the_team']==0){ echo "checked ";} }?> value="0"> Disable
  									<div class="text-danger">	<?php echo form_error('team_logo'); ?></div>
   								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<button type="submit" class="btn btn-default">Submit</button>
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