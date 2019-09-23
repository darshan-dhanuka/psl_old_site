<!-- top tiles -->
<div class="row">
	<h2>Manage Home Page</h2>
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
					<a>Home Page</a>
				</li>
			</ul>
			<?php $post_data = isset($homeInfo)?$homeInfo:array();?>
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">																															
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Logo:</label>
									<?php if(isset($post_data['logo'])){?>
										 <img src="<?php echo IMAGES_PATH?>/<?php echo $post_data['logo']; ?>" alt="" style="max-height:150px; max-width:150px; background-color:#d3d3d3;">
									<?php }?>
									<div class="col-sm-5">
										<input type="file"  class="form-control" name="logo">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Favicon:</label>
									<?php if(isset($post_data['favicon'])){?>
										 <img src="<?php echo IMAGES_PATH?>/<?php echo $post_data['favicon']; ?>" alt="" style="max-height:150px; max-width:150px;">
									<?php }?>
									<div class="col-sm-5">
										<input type="file"  class="form-control" name="favicon">
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-sm-2" for="">SEO Title:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="seo_title" placeholder="Page SEO Title" maxlength="255" value="<?php echo isset($post_data['seo_title'])?$post_data['seo_title']:'';?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Meta Tag:</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="5" id="" name="seo_meta"><?php echo isset($post_data['seo_meta'])?$post_data['seo_meta']:'';?></textarea>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Content:</label>
									<div class="col-sm-5">
										<textarea class="form-control tinymce" rows="5" id="" name="home_content" ><?php echo isset($post_data['home_content'])?$post_data['home_content']:'';?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Team Heading:<span class="text-danger">*</span></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="home_team_heading" placeholder="Home Team Heading" maxlength="300" value="<?php echo isset($post_data['home_team_heading'])?$post_data['home_team_heading']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home About PSL:</label>
									<div class="col-sm-5">
										<textarea class="form-control tinymce" rows="5" id="" name="home_about_psl" ><?php echo isset($post_data['home_about_psl'])?$post_data['home_about_psl']:'';?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Draft Heading:<span class="text-danger">*</span></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="home_draft_heading" placeholder="Home Draft Heading" maxlength="300" value="<?php echo isset($post_data['home_draft_heading'])?$post_data['home_draft_heading']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Draft Content:</label>
									<div class="col-sm-5">
										<textarea class="form-control tinymce" rows="5" id="" name="home_draft_content" ><?php echo isset($post_data['home_draft_content'])?$post_data['home_draft_content']:'';?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Mentor Heading:<span class="text-danger">*</span></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="home_mentor_heading" placeholder="Home Mentor Heading" maxlength="300" value="<?php echo isset($post_data['home_mentor_heading'])?$post_data['home_mentor_heading']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Partner Heading:<span class="text-danger">*</span></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="home_partner_heading" placeholder="Home Partner Heading" maxlength="300" value="<?php echo isset($post_data['home_partner_heading'])?$post_data['home_partner_heading']:'';?>" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Home Partner Content:</label>
									<div class="col-sm-5">
										<textarea class="form-control tinymce" rows="5" id="" name="home_partner_content" ><?php echo isset($post_data['home_partner_content'])?$post_data['home_partner_content']:'';?></textarea>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Copyright text:<span class="text-danger">*</span></label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="copyright_text" placeholder="Copyright Text" maxlength="300" value="<?php echo isset($post_data['copyright_text'])?$post_data['copyright_text']:'';?>" required>
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Footer script:</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="5" id="" name="footer_script" ><?php echo isset($post_data['footer_script'])?$post_data['footer_script']:'';?></textarea>
									</div>
								</div>														
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<button type="submit" class="btn btn-primary" name="add"> Update</button>
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