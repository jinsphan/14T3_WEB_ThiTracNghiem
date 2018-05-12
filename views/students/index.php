<?php include_once 'views/layout/'.$this->layout.'header.php'; ?>
<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-9">
	<div class="table-responsive">
	  <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Class</th>
            <th>Photo</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
		<?php while($row = mysqli_fetch_array($this->records)) : ?>
		  <tr>
			<th width="5%" scope="row"><?php echo $row['id']; ?></th>
			<td width="12%"><?php echo $row['fullname']; ?></td>
			<td width="30%"><?php echo $row['address']; ?></td>
			<td width="12%"><?php echo $row['phone']; ?></td>
			<td width="11%"><?php echo $row['classname']; ?></td>
			<td width="15%"><img src="<?php echo "media/upload/" .$this->controller.'/'.$row['photo']; ?>" alt="<?php echo $row['fullname']; ?>" class="img-thumbnail"></td>
			<td width="15%">
			  <a href="<?php echo html_helper::url(
							array('ctl'=>'students', 
								  'act'=>'view', 
								  'params'=>array(
									'id'=>$row['id']
							))); ?>" class="table-link">
				<span class="fa-stack">
				<i class="fa fa-square fa-stack-2x"></i>
				<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
				</span>
			  </a>
			  <a href="<?php echo html_helper::url(
							array('ctl'=>'students', 
								  'act'=>'edit', 
								  'params'=>array(
									'id'=>$row['id']
							))); ?>" class="table-link">
				<span class="fa-stack">
				<i class="fa fa-square fa-stack-2x"></i>
				<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
				</span>
			  </a>
			  <a href="<?php echo html_helper::url(
							array('ctl'=>'students', 
								  'act'=>'del', 
								  'params'=>array(
									'id'=>$row['id']
							))); ?>" class="table-link danger delete">
				<span class="fa-stack">
				<i class="fa fa-square fa-stack-2x"></i>
				<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
				</span>
			  </a>
			</td>
		  </tr>
		<?php endwhile; ?>
        </tbody>
      </table>
	</div>
  </div>
  <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	<?php include_once 'views/widgets/sidebar.php'; ?>
  </div>
</div>
<script src="media/js/students.js"></script>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>