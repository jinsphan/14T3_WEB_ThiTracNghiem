<?php include_once 'views/admin/layout/'.$this->layout.'header.php'; ?>
<script type="text/javascript">
	var numAllUser = parseInt(<?php echo $this->numAllUsers; ?>);
	var num_user_perPage = parseInt(<?php echo NUM_TOP_USERS; ?>);
</script>

<section class="content-header">
  <h1>
    Users
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
			      <h3 class="box-title">Data Table With Full Features</h3>
			    </div>
			    <!-- /.box-header -->
			    
			    <div class="box-body">
			    	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
			    		<div class="row">
			    			<div class="col-sm-6">
			    				<div class="dataTables_length" id="example1_length">
			    					<label>
			    						Show
			    						<select name="example1_length" aria-controls = "example1" class="form-control input-sm">
			    							<option value="10">10</option>
			    							<option value="25">25</option>
			    							<option value="50">50</option>
			    							<option value="100">100</option>
			    						</select>
			    						entries
			    					</label>
			    				</div>
			    			</div>
			    			<div class="col-sm-6">
			    				<div id="table_filter" class="pull-right">
			    					<label>Search:
			    						<div class="input-group">
										    <input type="text" class="form-control input-sm" aria-controls="example1" placeholder="Search">
										    <div class="input-group-btn">
										      <button id="submit-search" class="btn btn-default btn-sm">
										        <i class="glyphicon glyphicon-search"></i>
										      </button>
										    </div>
										</div>
			    					</label>
			    				</div>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<div class="col-sm-6">
			    				<button id="add-user" type = "button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			    					<i class="fa fa-plus"></i>
			    				</button>	
			    				
			    				<button id="delete-users" class="btn btn-danger">
			    					<i class="fa fa-trash-o"></i>
			    				</button>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<div class="col-sm-12">
			    				<table id="table_user_ctent" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checkboxAll" class="checkboxUser" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th>Username</th>
			    							<th>Status</th>
			    							<th>Date Created</th>
			    							<th>Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-users">
			    						
			    						<!-- rowDATA -->

			    						<?php foreach ($this->rowTop10 as $key => $value) { ?>
			    						<tr role="row">
			                  <td id="<?php echo("checkbox".$value['account_id']);?>" class="checkboxUser">
			                  	<input type="checkbox" name="">
			                  </td>
			                  <td id="<?php echo("username".$value['account_id']);?>">
			                  	<?php echo $value['username']; ?>		
			                  </td>
			                  <td id="<?php echo("account_status".$value['account_id']);?>">
			                  	<?php 
			                  	switch ($value['account_status']) {
			                  		case '0':
			                  			echo "Disable";
			                  			break;
			                  		case '1':
			                  			echo "Enable";
			                  			break;
			                  	} 
			                  ?></td>
			                  <td id="<?php echo("date_created".$value['account_id']);?>">
			                  	<?php echo $value['date_created']; ?>
			                  </td>
			                  <td  class="btn-act" class="pull-right">
			                  	<button id="<?php echo("view".$value['account_id']);?>" type="button" class="btn btn-success view-user" data-toggle="modal" data-target="#myModal">
			                  		<i class="fa fa-search-plus" aria-hidden="true"></i>
			                  	</button>
			                  	<button id="<?php echo("edit".$value['account_id']);?>" type="button" class="btn btn-primary edit-user" data-toggle="modal" data-target="#myModal">
			                  		<i class="fa fa-pencil"></i>
			                  	</button>
			                  	<button id="<?php echo("dele".$value['account_id']);?>" type="button" class="btn btn-danger dele-user">
			                  		<i class="fa fa-trash-o"></i>
			                  	</button>
			                  </td>
			                </tr>
			                <?php } ?>
			                <!-- rowDATA -->

			    					</tbody>

			    					<tfoot>
		                	<tr>
		                		<th rowspan="1" colspan="1"><i class="fa fa-check-square-o" aria-hidden="true"></i></th>
		                		<th rowspan="1" colspan="1">Username</th>
		                		<th rowspan="1" colspan="1">Status</th>
		                		<th rowspan="1" colspan="1">Date created</th>
		                		<th rowspan="1" colspan="1">Action</th>
		                	</tr>
		                </tfoot>
			    				</table>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<div class="col-sm-5"><div class="dataTables_info" id="table_info" role="status" aria-live="polite">
			    				<?php echo "Showing 1 to ".NUM_TOP_USERS." of {$this->numAllUsers} entries"; ?>
			    			</div></div>

			    			<div class="col-sm-7">
			    				<div class="dataTables_paginate paging_simple_numbers" id="table_paginate">
			    					<ul class="pagination pull-right">
			    						<li class="paginate_button previous disabled" id="table_previous">
			    							<a href="javascript:void(0);" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
			    						</li>

			    						<?php for($i = 1; $i <= ceil($this->numAllUsers/NUM_TOP_USERS); $i++){ ?>
											<li class="paginate_button <?php if($i==1) echo('active') ?>">
												<a href="javascript:void(0);" aria-controls="example1" data-dt-idx="<?php echo($i); ?>" tabindex="0"><?php echo($i); ?></a>
											</li>
										<?php } ?>

											<li class="paginate_button next" id="table_next">
												<a href="javascript:void(0);" aria-controls="example1" data-dt-idx="<?php echo(ceil($this->numAllUsers/NUM_TOP_USERS)+1) ?>" tabindex="0">Next
												</a>
			    						</li>
			    					</ul>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</section>

<div id="modal-user">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <table class="table table-hover">
			    	<thead>
				      <tr class="row">
				        <th class="col-sm-4">COLUMN</th>
				        <th class="col-sm-8">VALUE</th>
				      </tr>
				    </thead>
				    <tbody id="modal-body">
				      <tr id="username-modal" class="row">
				        <td class="col-sm-4">Username</td>
				        <td class="col-sm-8"></td>
				      </tr>
							<tr id="password-modal" class="row hidden">
				        <td class="col-sm-4">Password</td>
				        <td class="col-sm-8">
									<input class="form-control" type="text" value="">
								</td>
				      </tr>
				     	<tr id="fullname-modal" class="row">
				        <td class="col-sm-4">Fullname</td>
				        <td class="col-sm-8"></td>
				      </tr>
							<tr id="sex-modal" class="row">
				        <td class="col-sm-4">Sex</td>
				        <td class="col-sm-8"></td>
				      </tr>
							<tr id="birthday-modal" class="row">
				        <td class="col-sm-4">Day of birth</td>
				        <td class="col-sm-8"></td>
				      </tr>
				      <tr id="role-modal" class="row">
				        <td class="col-sm-4">Role</td>
				        <td class="col-sm-8"></td>
				      </tr>
				      <tr id="status-modal" class="row">
				        <td class="col-sm-4">Status</td>
				        <td class="col-sm-8"></td>
				      </tr>
				      <tr id="created-modal" class="row">
				        <td class="col-sm-4">Created</td>
				        <td class="col-sm-8"></td>
				      </tr>
				    </tbody>
				  </table>					
        </div>
        <div class="modal-footer">
          <button id="submit-btn-view" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="submit-btn-add" class="btn btn-default" data-dismiss="modal">Add</button>
          <button id="submit-btn-done" type="button" class="btn btn-default" data-dismiss="modal">Done</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>