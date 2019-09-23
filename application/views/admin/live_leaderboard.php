<div class="row">
	<h2>Upload Leaderboard</h2>
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
					<a>Upload Live Leaderboard</a>
				</li>
			</ul>			
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">								
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Upload File:</label>
									<div class="col-sm-5">
										<input type="file"  required class="form-control" name="userfile">(only CSV and comma seprated)
										<div class="text-danger"><?php echo form_error("userfile"); ?></div>
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-5">
										<button type="submit" class="btn btn-primary" name="add"> Upload</button>
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