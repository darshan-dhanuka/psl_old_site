<div class="row">
	<h2>Upload Score</h2>
</div>
<div class="row">
<div class="col-sm-5" style="margin-top:20px;">
	<a href="fantasy/downloadUser" class="btn btn-primary"> Download User</a>
	<a href="fantasy/downloadLeaderboard" class="btn btn-primary"> Download Leaderboard</a>
</div>
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
					<a>Upload Score</a>
				</li>
				<li>
					<a href="/admin/fantasy/manageFantasyUsers">Fantasy User score</a>
				</li>
			</ul>			
			<div class="tab-pane active">
				<div class="tab-content">
				<?php if(isset($invalidUser) && $invalidUser!=NULL ){
					echo "<div class='text-danger'>Invalid user<br></div>";
						foreach ($invalidUser as$user){
							echo $user."<br>";
						}
				}
				else if(isset($upload_success) && $upload_success)
				{
					echo "<div class='text-active'>Score Updated Successfully<br></div>";
				}
				?>
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">	
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Day:</label>
									<div class="col-sm-5">
										<select name='day'>
										<option value="<?php echo "-1";?>"><?php echo "Select Day";?></option>
										<?php for($i=1;$i<=PSL_SCORE_DAY;$i++){?>
										<option value="<?php echo $i;?>"><?php echo "Day-".$i;?></option>
										<?php }?>
										</select>
									</div>
								</div>									
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
					<div>
					<div>CSV format</div>
					<img src="<?php echo ADMIN_IMAGES_PATH;?>/screenshot2.png"> 
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Page Body End-->
</div>