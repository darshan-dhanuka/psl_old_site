<!-- top tiles -->
<div class="row">
	<h2>Upload Image</h2>
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
					<a>Upload CMS Image</a>
				</li>
			</ul>			
			<div class="tab-pane active">
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<form class="form-horizontal fv-form fv-form-bootstrap" method="post" enctype="multipart/form-data">								
								<div class="form-group">
									<label class="control-label col-sm-2" for="">Upload Image:</label>
									<div class="col-sm-5">
										<input type="file"  required class="form-control" name="upload_image">
									</div>
								</div>
								<?php if($this->session->flashdata('img_url')){ ?>
								<div class="form-group">
									<label class="col-sm-offset-2 col-sm-5 btn btn-primary" for="" onclick="copyToClipboard('<?php  echo $this->session->flashdata('img_url');?>')"><?php $a=$this->session->flashdata('img_url'); if($a!=""){?>Click to copy: <?php } else {echo "Upload Image";} echo $this->session->flashdata('img_url');?></label>									
								</div>	
								<?php } ?>
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
<script>
    function copyToClipboard(val){
      var dummy = document.createElement("input");
      document.body.appendChild(dummy);
      dummy.setAttribute("id", "dummy_id");
      document.getElementById("dummy_id").value=val;
      dummy.select();
      document.execCommand("copy");
      document.body.removeChild(dummy);
      alert("Url copied successfully");
    }
</script>