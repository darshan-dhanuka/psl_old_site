<!-- top tiles -->
<div class="row">
	<h2>Manage Page</h2>
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
					<a>Page List</a>
				</li>
				<li>
					<a href="/admin/cms/addNew">Add Page</a>
				</li>
			</ul>
			<div class="tab-pane active">
				<div class="tab-content">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sr.</th>
								<th>Page Name</th>
								<th>Page URL</th>
								<th>Last Modified</th>
								<th>Update By</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php $i=1;if ($results) { ?>
						<?php foreach ($results as $data) { ?>
						<tbody>
							<tr>
								<td><?php echo $i++;?></td>
								<td>
									<?php echo ucwords($data->page_name);?>
								</td>
								<td>
									<a href="<?php echo base_url().$data->page_url;?>" target="_BLANK"><?php echo base_url().$data->page_url;?></a>
								</td>
								<td>
									<?php echo date('d-m-Y H:i',$data->linux_modified_on);?>
								</td>
								<td>
									<?php echo ucwords($data->author_name);?>
								</td>
								<td class="btnsec">
									<?php if($data->page_status == 0){?>
									<a href="/admin/cms/updateStatus/active/<?php echo $data->page_id;?>" onclick="return confirm('Are you sure? You want to active page <?php echo $data->page_name;?>.');"
									    class="btn-success">Activate</a>
									<?php }if($data->page_status == 1){?>
									<a href="/admin/cms/updateStatus/inactive/<?php echo $data->page_id;?>" onclick="return confirm('Are you sure? You want to inactive page <?php echo $data->page_name;?>.');"
									    class="btn-success">Inactivate</a>
									<?php }?>
									<a href="/admin/cms/delete/<?php echo $data->page_id;?>" onclick="return confirm('Are you sure? You want to delete page <?php echo $data->page_name;?>.');"
									    class="btn-danger">Delete</a>
									<a href="/admin/cms/edit/<?php echo $data->page_id;?>" onclick="return confirm('Are you sure? You want to edit page <?php echo $data->page_name;?>.');"
									    class="btn-info">Edit</a>
								</td>
							</tr>
						</tbody>
						<?php }}else{?>
						<tbody>
							<tr>
								<td colspan="6">page List Not Available</td>
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