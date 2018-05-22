<?php include_once 'views/admin/layout/'.$this->layout.'header.php'; ?>
<script type="text/javascript">
	var numAllUser = parseInt(<?php echo $this->numAllUsers; ?>);
	var num_user_perPage = parseInt(<?php echo NUM_TOP_USERS; ?>);
</script>

<section class="content-header">
  <h1>
    Subject
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
			    				<button id="add-subject" type = "button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
			    					<i class="fa fa-plus"></i>
			    				</button>	
			    				
			    				<button id="delete-users" class="btn btn-danger">
			    					<i class="fa fa-trash-o"></i>
			    				</button>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<div class="col-sm-12">
			    				<table id="table_subjects" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checkboxAll" class="checkboxUser" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th>Subject Id</th>
			    							<th>Subject name</th>
			    							<th>Created</th>
			    							<th>Status</th>
			    							<th>Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-subjects">
			    						
			    						<!-- rowDATA -->

			    						<tr role="row">
                                            <td class="checkboxUser">
                                                <input type="checkbox" name="">
                                            </td>
                                            <td>
                                                1
                                            </td>
                                            <td>
                                                Vat li
                                            </td>
                                            <td>
                                                02/05/2018
                                            </td>
                                            <td>
                                                Enable
                                            </td>
                                            <td  class="btn-act" class="pull-right">
                                                <button id="" type="button" class="btn btn-primary edit-user" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
			    					</tbody>
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

<div id="modal-subject">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal-title">Modal Edit Subject</h4>
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
                    <tr id="subject_name-modal" class="row">
                        <td class="col-sm-4">Subject name</td>
                        <td class="col-sm-8"><input class='form-control' type="text"></td>
                    </tr>
                    <tr id="description-modal" class="row">
                        <td class="col-sm-4">Description</td>
                        <td class="col-sm-8"><input class='form-control' type="text"></td>
                    </tr>
                    <tr id="subject_status-modal" class="row">
                        <td class="col-sm-4">Status</td>
                        <td class="col-sm-8">
                            <div class='form-group'>
                                <select class='form-control'>
                                    <option value="0">Disable</option>
                                    <option value="1">Enable</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="parent_subject_id-modal" class="row">
                        <td class="col-sm-4">Parent</td>
                        <td class="col-sm-8">
                            <div class='form-group'>
                                <select class='form-control' id='sel1'>
                                    <option key="0">Vat li</option>
                                    <option key="0">Hoa hoc</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>					
        </div>
        <div class="modal-footer">
          <button id="btn-submit-update" type="button" class="btn btn-default" data-dismiss="modal">Update</button>
          <button id="btn-submit-add" type="button" class="btn btn-default" data-dismiss="modal">Add</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<script src="/media/admin/js/subjects.js"></script>

  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>