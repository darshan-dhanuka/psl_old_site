<!-- top tiles -->
<div class="row">
	<h2>Manage Page</h2>
</div>
<div class="row">
	<div style="min-height: 50px">
		<?php echo $this->session->flashdata('msg');?>
	</div>
</div>
<div class="row">
	<!--Page Body Start-->
	<div class="col-md-12">
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<?php if($form == 'edit'){?>
				<li><a href="/admin/cms" onclick="return confirm('Your edited item will be discarded.');">Page
						List</a></li>
				<li><a href="/admin/cms/addNew" onclick="return confirm('Your edited item will be discarded.');">Add
						Page</a></li>
				<li class="active"><a>Edit Page</a></li>
				<?php }else{?>
				<li><a href="/admin/cms">Page List</a></li>
				<li class="active"><a>Add Page</a></li>
				<?php }?>
			</ul>
			<?php $post_data = array();$post_data = ($form == 'edit')?$cms:$this->session->flashdata('post_data');?>
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">
								<input type="hidden" name="page_id" value="<?php echo (isset($post_data['page_id'])?$post_data['page_id']:'');?>">
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">page Name:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" pattern="[A-Za-z0-9-_]{3,}" title="Only A-Z a-z 0-9 - _ are allowed. Minimum 3 character"
										    name="page_name" placeholder="Page Name" maxlength="100" value="<?php echo isset($post_data['page_name'])?$post_data['page_name']:'';?>"
										    required>
									</div>
								</div>
								<div class="form-group required">
									<label class="control-label col-sm-2" for="">Page URL:</label>
									<div class="col-sm-5">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon3"><?php echo base_url();?></span>
											<input type="text" class="form-control" pattern="[A-Za-z0-9-_/]{3,}" title="Only A-Z a-z 0-9 '-' '_'  '/' are allowed. Minimum 3 character"
											    name="page_url" placeholder="Page URL" maxlength="255" value="<?php echo isset($post_data['page_url'])?$post_data['page_url']:'';?>"
											    required>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<label class="control-label col-sm-2" for="">Page Description:</label>
									<div class="col-sm-5">
										<textarea class="form-control tinymce" rows="5" id="" name="page_description"><?php echo isset($post_data['page_description'])?$post_data['page_description']:'';?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Page SEO Title:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="seo_title" placeholder="Page SEO Title" maxlength="255" value="<?php echo isset($post_data['seo_title'])?$post_data['seo_title']:'';?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Page Meta Tag:</label>
									<div class="col-sm-5">
										<textarea class="form-control" rows="5" id="" name="seo_meta"><?php echo isset($post_data['seo_meta'])?$post_data['seo_meta']:'';?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Page Heading:</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" name="page_heading" placeholder="Page Heading" maxlength="100" value="<?php echo isset($post_data['page_heading'])?$post_data['page_heading']:'';?>">
									</div>
								</div>
								<div class="form-group  <?php echo ($form=='edit' )? '': 'required'?>">
									<label class="control-label col-sm-2" for="">Page Desktop
										Banner:</label>
									<div class="col-sm-5">
										<input type="file" class="form-control" name="page_desktop_banner" <?php echo ($form=='edit' )? '': 'required'?>>
									</div>
								</div>
								<div class="form-group"  <?php echo ($form=='edit' )? '': 'required'?>>
									<label class="control-label col-sm-2" for="">Page Mobile
										Banner:</label>
									<div class="col-sm-5">
										<input type="file" class="form-control" name="page_mobile_banner" <?php echo ($form=='edit' )? '': 'required'?>>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Page status:</label>
									<div class="col-sm-5">
										<div class="radio col-sm-2">
											<label><input type="radio" name="page_status" value="1"
												<?php echo isset($post_data['page_status'])?(($post_data['page_status'] == 1)?'checked':''):'checked';?>>Active</label>
										</div>
										<div class="radio col-sm-2">
											<label><input type="radio" name="page_status" value="0"
												<?php echo isset($post_data['page_status'])?(($post_data['page_status'] == 0)?'checked':''):'';?>>Inactive</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<button type="submit" class="btn btn-primary" name="add"> <?php echo ($form == 'edit')?'Update Page':'Add Page'?></button>
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